/*
 *   big-block-hotel-number
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let InnerBlocks = blockEditor.InnerBlocks;
  let RichText = blockEditor.RichText;
  let allowedBlocks = ["core/image"];

  blocks.registerBlockType("custom/big-block-hotel-number", {
    title: "big-block-hotel-number",
    category: "common",
    keywords: "big-block-hotel-number",
    icon: "block-default",
    attributes: {
      title: { type: "string", source: "html", selector: "p.title" },
      description: {
        type: "string",
        source: "html",
        selector: "p.description",
      },
      link: { type: "string", source: "html", selector: "span.link" },
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
        el(RichText, {
          tagName: "p",
          className: "title",
          placeholder: "Title",
          value: attributes.title,
          onChange: function (value) {
            props.setAttributes({ title: value });
          },
        }),
        el(RichText, {
          tagName: "p",
          className: "description",
          placeholder: "Description",
          value: attributes.description,
          onChange: function (value) {
            props.setAttributes({ description: value });
          },
        }),
        el(RichText, {
          tagName: "span",
          className: "link",
          placeholder: "Link",
          value: attributes.link,
          onChange: function (value) {
            props.setAttributes({ link: value });
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
        el(InnerBlocks.Content, {}),
        el(
          "div",
          blockProps,
          el(RichText.Content, {
            tagName: "p",
            className: "title",
            value: attributes.title,
          }),
          el(RichText.Content, {
            tagName: "p",
            className: "description",
            value: attributes.description,
          }),
          el(RichText.Content, {
            tagName: "span",
            className: "link",
            value: attributes.link,
          })
        )
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
