/* block.js */
var el = wp.element.createElement;

wp.blocks.registerBlockType('brsc-gutenberg/notice-block', {

  title: 'BRSC Card', // Block name visible to user

  icon: 'lightbulb', // Toolbar icon can be either using WP Dashicons or custom SVG

  category: 'common', // Under which category the block would appear

  attributes: { // The data this block will be storing

    type: { type: 'string', default: 'default' }, // Notice box type for loading the appropriate CSS class. Default class is 'default'.

    title: { type: 'string' }, // Notice box title in h4 tag

    content: { type: 'array', source: 'children', selector: 'p' }, /// Notice box content in p tagName

  },


  edit: function (props) {
    // How our block renders in the editor in edit mode

    function updateTitle(event) {
      props.setAttributes({ title: event.target.value });
    }

    function updateContent(newdata) {
      props.setAttributes({ content: newdata });
    }

    function updateType(event) {
      props.setAttributes({ type: event.target.value });
    }

    return el('div',
      {
        className: `notice-box notice-${props.attributes.type} card-edit-view`
      },
      el(
        'select',
        {
          onChange: updateType,
          value: props.attributes.type,
        },
        el("option", { value: "grey" }, "Grey"),
        el("option", { value: "red" }, "Red"),
        el("option", { value: "navy" }, "Navy")
      ),
      el(
        'input',
        {
          type: 'text',
          placeholder: 'Enter title here...',
          value: props.attributes.title,
          onChange: updateTitle,
          style: { width: '100%' }
        }
      ),
      el(
        wp.editor.RichText,
        {
          tagName: 'p',
          onChange: updateContent,
          value: props.attributes.content,
          placeholder: 'Enter text here...'
        }
      )
    ); // End return

  },  // End edit()

  save: function (props) {
    // How our block renders on the frontend

    return el('div',
      {
        className: 'notice-box notice-' + props.attributes.type
      },
      el(
        'h4',
        null,
        props.attributes.title
      ),
      el(wp.editor.RichText.Content, {
        tagName: 'p',
        value: props.attributes.content
      })

    ); // End return

  } // End save()
});
