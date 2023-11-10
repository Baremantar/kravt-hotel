/*
 *   block
 */

(function (blocks, element, blockEditor) {
  let el = element.createElement;
  let InnerBlocks = blockEditor.InnerBlocks;

  blocks.registerBlockType("custom/block", {
    title: "block",
    category: "common",
    keywords: "block",
    icon: "block-default",

    edit: function (props) {
      const style = {
        padding: "20px",
        border: "1px solid #e1e2e1",
        borderRadius: "8px",
      };
      const blockProps = blockEditor.useBlockProps({
        style: style,
      });

      return el("div", blockProps, el(InnerBlocks));
    },

    save: function () {
      const style = {
        padding: "20px",
        border: "1px solid #9bd03d;",
        borderRadius: "8px",
      };
      const blockProps = blockEditor.useBlockProps.save({
        style: style,
      });
      return el("div", blockProps, el(InnerBlocks.Content));
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
