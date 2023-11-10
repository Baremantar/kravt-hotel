/*
 *   beside-block
 */

(function (blocks, element, blockEditor) {
    let el = element.createElement;
    let RichText = blockEditor.RichText;
    let InnerBlocks = blockEditor.InnerBlocks;
    let allowedBlocks = ["core/image"];
  
    blocks.registerBlockType("custom/beside-block", {
      title: "beside-block",
      category: "common",
      keywords: "beside-block",
      icon: "block-default",
      attributes: {
        time: { type: "string", source: "html", selector: "p.time" },
        place: { type: "string", source: "html", selector: "span.place" },
        typeOfTransport: { type: "string", source: "html", selector: "span.typeOfTransport" },
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
          el(InnerBlocks, {allowedBlocks:allowedBlocks}),
          el("div", className="wrapper",
          el(RichText, {
            tagName: "p",
            format: "string",
            className: 'time',
            placeholder: "Время",
            value: attributes.time,
            onChange: function (value) {
              props.setAttributes({ time: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            format: "string",
            className: 'place',
            placeholder: "Место",
            value: attributes.place,
            onChange: function (value) {
              props.setAttributes({ place: value });
            },
          }),
          el(RichText, {
            tagName: "span",
            format: "string",
            className: 'typeOfTransport',
            placeholder: "Тип транспорта",
            value: attributes.typeOfTransport,
            onChange: function (value) {
              props.setAttributes({ typeOfTransport: value });
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
            tagName: "p",
            className: "time",
            value: attributes.time,
          }),
          el(RichText.Content, {
            tagName: "span",
            className: "place",
            value: attributes.place,
          }),
          el(RichText.Content, {
            tagName: "span",
            className: "typeOfTransport",
            value: attributes.typeOfTransport,
          }),
          
        );
      },
    });
  })(window.wp.blocks, window.wp.element, window.wp.blockEditor);
  