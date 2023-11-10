/*
 *   content-span-p
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let RichText = blockEditor.RichText;

  blocks.registerBlockType("custom/content-span-p", {
    title: "content-span-p",
    category: "common",
    keywords: "content-span-p",
    icon: "block-default",
    attributes: {
      title: { type: "string", source: "html", selector: "span" },
      description: { type: "string", source: "html", selector: "p" },
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
          tagName: "span",
          format: "string",
          placeholder: "Title",
          value: attributes.title,
          onChange: function (value) {
            props.setAttributes({ title: value });
          },
        }),
        el(RichText, {
          tagName: "p",
          format: "string",
          placeholder: "Description",
          value: attributes.description,
          onChange: function (value) {
            props.setAttributes({ description: value });
          },
        })
      );
    },

    save: function (props) {
      const attributes = props.attributes;
      const blockProps = blockEditor.useBlockProps.save({});
      return el(
        "div",
        blockProps,
        el(RichText.Content, {
          tagName: "span",
          format: "string",
          value: attributes.title,
        }),
        el(RichText.Content, {
          tagName: "p",
          format: "string",
          value: attributes.description,
        })
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
