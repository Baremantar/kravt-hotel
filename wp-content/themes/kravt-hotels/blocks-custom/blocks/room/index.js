/*
 *   room
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let RichText = blockEditor.RichText;
  let InnerBlocks = blockEditor.InnerBlocks;
  let allowedBlocks = [
    "core/image",
    "core/list",
    "custom/room-type",
    "custom/slider-item",
    "core/gallery",
    "custom/content-span-p",
    "custom/link",
  ];

  blocks.registerBlockType("custom/room", {
    title: "room",
    category: "common",
    keywords: "room",
    icon: "block-default",
    attributes: {
      descriptionFull: {
        type: "string",
        source: "html",
        selector: "p.description-full",
      },
    },

    edit: function (props) {
      const attributes = props.attributes;

      const style = {
        padding: "20px",
        border: "1px solid #e1e2e1",
        borderRadius: "8px",
        display: "flex",
        flexDirection: "column",
      };

      const blockProps = blockEditor.useBlockProps({
        style: style,
      });

      return el(
        "div",
        blockProps,
        el(RichText, {
          tagName: "p",
          className: "description-full",
          placeholder: "Описание",
          value: attributes.descriptionFull,
          onChange: function (value) {
            props.setAttributes({ descriptionFull: value });
          },
        }),
        el(InnerBlocks, {
          allowedBlocks: allowedBlocks,
        }),
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
          className: "description-full",
          value: attributes.descriptionFull,
        }),
        el(InnerBlocks.Content)
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
