/*
 *   link
 */

(function (blocks, element, blockEditor) {
    let el = element.createElement;
    let InnerBlocks = blockEditor.InnerBlocks;
  
    blocks.registerBlockType("custom/link", {
      title: "link",
      category: "common",
      keywords: "link",
      icon: "admin-links",
  
      edit: function () {
        return el("a", {}, el(InnerBlocks));
      },
  
      save: function () {
        return el("a", {}, el(InnerBlocks.Content));
      },
    });
  })(window.wp.blocks, window.wp.element, window.wp.blockEditor);
  