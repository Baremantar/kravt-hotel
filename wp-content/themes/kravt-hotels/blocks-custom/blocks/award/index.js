/*
 *   award
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let RichText = blockEditor.RichText;
  let InnerBlocks = blockEditor.InnerBlocks;
  let allowedBlocks = [ 'core/image'];

  blocks.registerBlockType("custom/award", {
    title: "award",
    category: "common",
    keywords: "award",
    icon: "block-default",
    attributes: {
      awardTitle: { type: "string", source: "html", selector: "p.award" }, 
      title: { type: "string", source: "html", selector: "p.title" },
      description: { type: "string", source: "html", selector: "span" },
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
        el(RichText, {
          tagName: "p",
          format: "string",
          className: "award",
          placeholder: "Award title",
          value: attributes.awardTitle,
          onChange: function (value) {
            props.setAttributes({ awardTitle: value });
          },
        }),
        el(RichText, {
          tagName: "p",
          format: "string",
          className: "title",
          placeholder: "Title",
          value: attributes.title,
          onChange: function (value) {
            props.setAttributes({ title: value });
          },
        }),
        el(RichText, {
          tagName: "span",
          format: "string",
          placeholder: "Description",
          value: attributes.description,
          onChange: function (value) {
            props.setAttributes({ description: value });
          },
        }),
        el(InnerBlocks, {allowedBlocks:allowedBlocks}),
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
          className:"award",
          format: "string",
          value: attributes.awardTitle,
        }),
        el(RichText.Content, {
          tagName: "p",
          className:"title",
          format: "string",
          value: attributes.title,
        }),
        el(RichText.Content, {
          tagName: "span",
          format: "string",
          value: attributes.description,
        }),
        el(InnerBlocks.Content)
      );
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
