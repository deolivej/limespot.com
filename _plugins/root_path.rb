"""
Plugin that adds the tag 'root_path' that allows us to address assets
in a portable way.
"""
module Jekyll
  class RootPathTag < Liquid::Tag

    def initialize(tag_name, text, tokens)
      super
    end

    def render(context)
      page_url = context.environments.first["page"]["url"]
      '../' * (page_url.count('/')-1)
    end
  end
end

Liquid::Template.register_tag('root_path', Jekyll::RootPathTag)
