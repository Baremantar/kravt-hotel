/*
 *   hotel-type
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let RichText = blockEditor.RichText;
  let InnerBlocks = blockEditor.InnerBlocks;
  let allowedBlocks = ["core/image"];

  blocks.registerBlockType("custom/hotel-type", {
    title: "hotel-type",
    category: "common",
    keywords: "hotel-type",
    icon: "block-default",
    attributes: {
      title: { type: "string", source: "html", selector: "span.title" },
      address: { type: "string", source: "html", selector: "span.address" },
      phone: { type: "string", source: "html", selector: "span.phone" },
      email: { type: "string", source: "html", selector: "span.email" },
      inst: { type: "string", source: "html", selector: "span.inst" },
      telegram: { type: "string", source: "html", selector: "span.telegram" },
      viber: { type: "string", source: "html", selector: "span.viber" },
      whatsapp: { type: "string", source: "html", selector: "span.whatsapp" },
      vk: { type: "string", source: "html", selector: "span.vk" },
    },

    edit: function (props) {
      const attributes = props.attributes;
      const style = {
        padding: "20px",
        display: "flex",
        borderRadius: "8px",
        border: "1px solid #e1e2e1",
        gap: "20px",
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
          (className = "wrapper"),
          el(RichText, {
            tagName: "span",
            className: "title",
            placeholder: "Title",
            value: attributes.title,
            onChange: function (value) {
              props.setAttributes({ title: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            className: "address",
            placeholder: "Address",
            value: attributes.address,
            onChange: function (value) {
              props.setAttributes({ address: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            className: "phone",
            placeholder: "Phone",
            value: attributes.phone,
            onChange: function (value) {
              props.setAttributes({ phone: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            className: "email",
            placeholder: "Email",
            value: attributes.email,
            onChange: function (value) {
              props.setAttributes({ email: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            className: "inst",
            placeholder: "Inst",
            value: attributes.inst,
            onChange: function (value) {
              props.setAttributes({ inst: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            className: "telegram",
            placeholder: "Telegram",
            value: attributes.telegram,
            onChange: function (value) {
              props.setAttributes({ telegram: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            className: "viber",
            placeholder: "Viber",
            value: attributes.viber,
            onChange: function (value) {
              props.setAttributes({ viber: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            className: "whatsapp",
            placeholder: "Whatsapp",
            value: attributes.whatsapp,
            onChange: function (value) {
              props.setAttributes({ whatsapp: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            className: "vk",
            placeholder: "VK",
            value: attributes.vk,
            onChange: function (value) {
              props.setAttributes({ vk: value });
            },
          }),
        )
      );
    },

    save: function (props) {
      const attributes = props.attributes;
      const blockProps = blockEditor.useBlockProps.save({});
      return el(
        "div",
        blockProps,
        el(InnerBlocks.Content),
        el(RichText.Content, {
          tagName: "span",
          className: "title",
          value: attributes.title,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "address",
          value: attributes.address,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "phone",
          value: attributes.phone,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "email",
          value: attributes.email,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "inst",
          value: attributes.inst,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "telegram",
          value: attributes.telegram,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "viber",
          value: attributes.viber,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "whatsapp",
          value: attributes.whatsapp,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "vk",
          value: attributes.vk,
        }),
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
