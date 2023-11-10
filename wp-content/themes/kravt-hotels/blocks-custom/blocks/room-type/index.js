/*
 *   room-type
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let RichText = blockEditor.RichText;

  blocks.registerBlockType("custom/room-type", {
    title: "room-type",
    category: "common",
    keywords: "room-type",
    icon: "block-default",
    attributes: {
      square: { type: "string", source: "html", selector: "span.square" },
      guests: { type: "string", source: "html", selector: "span.guests" },
      splitSystem: {
        type: "string",
        source: "html",
        selector: "span.splitSystem",
      },
      beds: { type: "string", source: "html", selector: "span.beds" },
      soundproofing: {
        type: "string",
        source: "html",
        selector: "span.soundproofing",
      },
      sweedishTable: {
        type: "string",
        source: "html",
        selector: "span.sweedishTable",
      },
    },

    edit: function (props) {
      const attributes = props.attributes;
      const style = {
        padding: "20px",
        display: "flex",
        flexDirection: "column",
        gap: "20px",
      };
      const blockProps = blockEditor.useBlockProps({
        style: style,
      });
      return el(
        "div",
        blockProps,
        el(RichText, {
          tagName: "span",
          className: "square",
          placeholder: "Площадь",
          value: attributes.square,
          onChange: function (value) {
            props.setAttributes({ square: value });
          },
        }),
        el(RichText, {
          tagName: "span",
          className: "guests",
          placeholder: "Количество гостей",
          value: attributes.guests,
          onChange: function (value) {
            props.setAttributes({ guests: value });
          },
        }),
        el(RichText, {
          tagName: "span",
          className: "splitSystem",
          placeholder: "Сплит-система",
          value: attributes.splitSystem,
          onChange: function (value) {
            props.setAttributes({ splitSystem: value });
          },
        }),
        el(RichText, {
          tagName: "span",
          className: "beds",
          placeholder: "Количество кроватей",
          value: attributes.beds,
          onChange: function (value) {
            props.setAttributes({ beds: value });
          },
        }),
        el(RichText, {
          tagName: "span",
          className: "soundproofing",
          placeholder: "Шумоизоляция, уровень",
          value: attributes.soundproofing,
          onChange: function (value) {
            props.setAttributes({ soundproofing: value });
          },
        }),
        el(RichText, {
          tagName: "span",
          className: "sweedishTable",
          placeholder: "Шведский стол",
          value: attributes.sweedishTable,
          onChange: function (value) {
            props.setAttributes({ sweedishTable: value });
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
          className: "square",
          value: attributes.square,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "guests",
          value: attributes.guests,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "splitSystem",
          value: attributes.splitSystem,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "beds",
          value: attributes.beds,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "soundproofing",
          value: attributes.soundproofing,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "sweedishTable",
          value: attributes.sweedishTable,
        })
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
