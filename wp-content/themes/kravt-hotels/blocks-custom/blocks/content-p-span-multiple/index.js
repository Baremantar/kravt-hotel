/*
 *   content-p-span-multiple
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let RichText = blockEditor.RichText;
  let InnerBlocks = blockEditor.InnerBlocks;
  let allowedBlocks = ['custom/span'];

  blocks.registerBlockType("custom/content-p-span-multiple", {
    title: "content-p-span-multiple",
    category: "common",
    keywords: "content-p-span-multiple",
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
        el(InnerBlocks, {allowedBlocks:allowedBlocks})
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
        el(InnerBlocks.Content, {})
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
