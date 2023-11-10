/*
 *   restaraunt-type
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let RichText = blockEditor.RichText;

  blocks.registerBlockType("custom/restaraunt-type", {
    title: "restaraunt-type",
    category: "common",
    keywords: "restaraunt-type",
    icon: "block-default",
    attributes: {
      workTime: {
        type: "string",
        source: "html",
        selector: "span.workTime",
      },
      kitchen: { type: "string", source: "html", selector: "span.kitchen" },
      capacity: {
        type: "string",
        source: "html",
        selector: "span.capacity",
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
          className: "workTime",
          placeholder: "Режим работы",
          value: attributes.workTime,
          onChange: function (value) {
            props.setAttributes({ workTime: value });
          },
        }),
        el(RichText, {
          tagName: "span",
          className: "kitchen",
          placeholder: "Кухня",
          value: attributes.kitchen,
          onChange: function (value) {
            props.setAttributes({ kitchen: value });
          },
        }),
        el(RichText, {
          tagName: "span",
          className: "capacity",
          placeholder: "Вместимость",
          value: attributes.capacity,
          onChange: function (value) {
            props.setAttributes({ capacity: value });
          },
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
          tagName: "span",
          className: "workTime",
          value: attributes.workTime,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "kitchen",
          value: attributes.kitchen,
        }),
        el(RichText.Content, {
          tagName: "span",
          className: "capacity",
          value: attributes.capacity,
        })
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
