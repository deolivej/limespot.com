"""
Plugin that adds the tag 'root_path' that allows us to address assets
in a portable way.
"""
module Jekyll
  class TocLinkTag < Liquid::Tag

    def initialize(tag_name, text, tokens)
      super
      @text = text
    end

    def render(context)
      page_name = context.environments.first["page"]["name"]
      'active' if page_name == @text
    end
  end
end

Liquid::Template.register_tag('toc_link', Jekyll::TocLinkTag)
