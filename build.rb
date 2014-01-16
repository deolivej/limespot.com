require 'liquid'
require 'find'
require 'yaml'
require 'fileutils'

class Renderer
  def initialize(config, build_dir)
    @config = config
    @build_dir = build_dir
  end

  def init()
    if File.exists?(@build_dir)
      FileUtils.rm_r(@build_dir)
    end
  end

  def render(file, dir)
    template = File.open('%s/%s' % [dir,file])
    begin
      # create desintation directory
      dest_dir = '%s/%s' % [@build_dir, dir]
      FileUtils::mkdir_p(dest_dir)

      t = Liquid::Template.parse(template.read)
      
      g = File.open('%s/%s' % [dest_dir, file.sub('.liquid','.html')], 'w')
      g.write(t.render(@config))
      g.close()
    ensure
      template.close()
    end
  end

  def finish()
    # copy over static resources
    Dir.foreach('_static') { |f|
      if f != '.' and f != '..'
        FileUtils.cp_r('%s/%s' % ['_static', f], @build_dir)
      end
    }
  end

end


# load config
config = YAML.load_file('config.yaml')

# set include dir for templates
Liquid::Template.file_system = Liquid::LocalFileSystem.new('_include')

# create renderer
r = Renderer.new(config, '_build')
r.init()

Find.find('.') do |path|
  base = File.basename(path)

  if base[0] == '_' or base == 'joomla'
    Find.prune
  else
    ext = File.extname(base)
    dir = File.dirname(path) 

    if ext == '.liquid'
      r.render(base, dir)
    end
  end
end

r.finish()
