/*
 *   content-item-1
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let InnerBlocks = blockEditor.InnerBlocks;
  let RichText = blockEditor.RichText;

  blocks.registerBlockType("custom/content-item-1", {
    title: "content-item-1",
    category: "common",
    keywords: "content-item-1",
    icon: "block-default",
    attributes: {
      title: { type: "string", source: "html", selector: "p" },
    },

    edit: function (props) {
      const attributes = props.attributes;
      const style = {
        padding: "20px",
        border: "1px solid #e1e2e1",
        borderRadius: "8px",
      };
      const blockProps = blockEditor.useBlockProps({
        style: style,
      });

      return el(
        "div",
        blockProps,
        el(RichText, {
          tagName: "p",
          format: "string",
          placeholder: "Title",
          value: attributes.title,
          onChange: function (value) {
            props.setAttributes({ title: value });
          },
        }),
        el("div", blockProps, el(InnerBlocks))
      );
    },

    save: function (props) {
      const attributes = props.attributes;
      const blockProps = blockEditor.useBlockProps.save({});
      return el(
        "div",
        blockProps,
        el(RichText.Content, {
          tagName: "p",
          format: "string",
          value: attributes.title,
        }),
        el(InnerBlocks.Content)
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
