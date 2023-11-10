/*
 *   slider-content-p-span-multiple
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let RichText = blockEditor.RichText;
  let InnerBlocks = blockEditor.InnerBlocks;
  let allowedBlocks = ["core/image"];

  blocks.registerBlockType("custom/slider-content-p-span-multiple", {
    title: "slider-content-p-span-multiple",
    category: "common",
    keywords: "slider-content-p-span-multiple",
    icon: "block-default",
    attributes: {
      title: { type: "string", source: "html", selector: "p.title" },
      city: { type: "string", source: "html", selector: "span.city" },
      description: {
        type: "string",
        source: "html",
        selector: "span.description",
      },
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
        el(InnerBlocks, { allowedBlocks: allowedBlocks }),
        el(
          "div",
          className="wrapper",
          el(RichText, {
            tagName: "p",
            className:"title",
            placeholder: "Title",
            value: attributes.title,
            onChange: function (value) {
              props.setAttributes({ title: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            className: "city",
            placeholder: "City",
            value: attributes.city,
            onChange: function (value) {
              props.setAttributes({ city: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            className: "description",
            placeholder: "Description",
            value: attributes.description,
            onChange: function (value) {
              props.setAttributes({ description: value });
            },
          })
        )
      );
    },

    save: function (props) {
      const attributes = props.attributes;
      const blockProps = blockEditor.useBlockProps.save({});
      return el(
        "div",
        blockProps,
        el(InnerBlocks.Content, {}),
        el(
          "div",
          blockProps,
          el(RichText.Content, {
            tagName: "p",
            className:"title",
            value: attributes.title,
          }),
          el(RichText.Content, {
            tagName: "span",
            className: "city",
            value: attributes.city,
          }),
          el(RichText.Content, {
            tagName: "span",
            className: "description",
            value: attributes.description,
          })
        )
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
