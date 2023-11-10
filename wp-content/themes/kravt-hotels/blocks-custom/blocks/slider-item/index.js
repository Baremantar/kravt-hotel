/*
 *   slider-item
 */

(function (blocks, element, blockEditor) {
    let el = element.createElement;
    let InnerBlocks = blockEditor.InnerBlocks;
    let RichText = blockEditor.RichText;
    let allowedBlocks = [ 'core/image'];
  
    blocks.registerBlockType("custom/slider-item", {
      title: "slider-item",
      category: "common",
      keywords: "slider-item",
      icon: "block-default",
      attributes: {
        title: { type: "string", source: "html", selector: "span" },
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
          el(RichText, {
            tagName: "span",
            format: "string",
            placeholder: "Title",
            value: attributes.title,
            onChange: function (value) {
              props.setAttributes({ title: value });
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
          el(InnerBlocks.Content),
          el(RichText.Content, {
            tagName: "span",
            format: "string",
            value: attributes.title,
          }),
        );
      },
    });
  })(window.wp.blocks, window.wp.element, window.wp.blockEditor);
  