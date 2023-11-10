/*
 *   span
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let RichText = blockEditor.RichText;

  blocks.registerBlockType("custom/span", {
    title: "span",
    category: "common",
    keywords: "span",
    icon: "block-default",

    attributes: {
      content: {
        type: "string",
        source: "html",
        selector: 'span',
      },
    },

    edit: function (props) {
      return el(RichText, {
        tagName: "span",
        format: "string",
        value: props.attributes.content,
        onChange: function (content) {
          props.setAttributes({ content: content });
        },
      });
    },

    save: function (props) {
      return el(RichText.Content, {
        tagName: "span",
        format: "string",
        value: props.attributes.content,
      });
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
