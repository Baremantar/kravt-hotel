/*
 *   news-block
 */

(function (blocks, element, blockEditor) {
    let el = element.createElement;
    let InnerBlocks = blockEditor.InnerBlocks;
    let RichText = blockEditor.RichText;
    let allowedBlocks = ["core/image"];

  
    blocks.registerBlockType("custom/news-block", {
      title: "news-block",
      category: "common",
      keywords: "news-block",
      icon: "block-default",
      attributes: {
        date: { type: "array", source: "children", selector: "span" },
        title: { type: "array", source: "children", selector: "h2" },
        description: { type: "array", source: "children", selector: "p" },
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
            (className = "wrapper"),
          el(RichText, {
            tagName: "span",
            placeholder: "Date",
            value: attributes.date,
            onChange: function (value) {
              props.setAttributes({ date: value });
            },
          }),
          el(RichText, {
            tagName: "h2",
            placeholder: "Title",
            value: attributes.title,
            onChange: function (value) {
              props.setAttributes({ title: value });
            },
          }),
          el(RichText, {
            tagName: "p",
            placeholder: "Description",
            value: attributes.description,
            onChange: function (value) {
              props.setAttributes({ description: value });
            },
          }),
        ));
      },
  
      save: function (props) {
        const attributes = props.attributes;
        const blockProps = blockEditor.useBlockProps.save({});
        return el(
          "div",
          blockProps,
          el(RichText.Content, { tagName: "span", value: attributes.date }),
          el(RichText.Content, { tagName: "h2", value: attributes.title }),
          el(RichText.Content, {
            tagName: "p",
            format: "string",
            value: attributes.description,
          }),
          el(InnerBlocks.Content, {}),
        );
      },
    });
  })(window.wp.blocks, window.wp.element, window.wp.blockEditor);
  