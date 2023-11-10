/*
 *   section-city
 */

(function (blocks, element, blockEditor) {
    let el = element.createElement;
    let InnerBlocks = blockEditor.InnerBlocks;
    let RichText = blockEditor.RichText;
    let allowedBlocks = ["custom/section-hotel-services"];
  
    blocks.registerBlockType("custom/section-city", {
      title: "section-city",
      category: "common",
      keywords: "section-city",
      icon: "block-default",
      attributes: {
        title: { type: "array", source: "children", selector: "h2" },
        description: { type: "array", source: "children", selector: "span" },
      },
  
      edit: function (props) {
        const attributes = props.attributes;
        const style = {
          padding: "15px",
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
            tagName: "h2",
            placeholder: "Title",
            value: attributes.title,
            onChange: function (value) {
              props.setAttributes({ title: value });
            },
          }),
          el("div", blockProps, el(InnerBlocks, {allowedBlocks: allowedBlocks }))
        );
      },
  
      save: function (props) {
        const attributes = props.attributes;
        const blockProps = blockEditor.useBlockProps.save({});
        return el(
          "div",
          blockProps,
          el(RichText.Content, { tagName: "h2", value: attributes.title }),
          el('div',blockProps, el(InnerBlocks.Content))
        );
      },
    });
  })(window.wp.blocks, window.wp.element, window.wp.blockEditor);
  