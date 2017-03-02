<html lang="es_ES">
<head>
 <script src="scripts/jquery.js"></script>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Messi, simple jQuery message plugin</title>
	<meta name="description" content="Messi, simple jQuery message plugin">
	<meta name="author" content="Marcos Esperón">

	<meta name="viewport" content="width=device-width">
	
  <link rel="stylesheet" href="styles/messi.css" />
  </head>
  <p>Simple message:</p>
    <ul>
      <li>
        <a id="simple">Simple message</a>
        <pre class="code">new Messi('This is a message with Messi.');</pre>
      </li>
      <li>
        <a id="title">Message with title.</a>
        <pre class="code">new Messi('This is a message with Messi.', {title: 'Title'});</pre>
      </li>
      <li>
        <a id="modal">Message in modal view.</a>
        <pre class="code">new Messi('This is a message with Messi in modal view. Now you can\'t interact with other elements in the page until close this.', {title: 'Modal Window', modal: true});</pre>
      </li>
      <li>
        <a id="absolute">Message in absolute position.</a>
        <pre class="code">new Messi('This is a message with Messi in absolute position.', {center: false, viewport: {top: '760px', left: '0px'}});</pre>
      </li>
    </ul>
    <p>Buttons:</p>
    <ul>
      <li>
        <a id="close-button">Message with custom button.</a>
        <pre class="code">new Messi('This is a message with Messi with custom buttons.', {title: 'Buttons', buttons: [{id: 0, label: 'Close', val: 'X'}]});</pre>
      </li>
      <li>
        <a id="yes-no-buttons">Message with custom buttons (yes/no) and callback function.</a>
        <pre class="code">new Messi('This is a message with Messi with custom buttons.', {title: 'Buttons', buttons: [{id: 0, label: 'Yes', val: 'Y'}, {id: 1, label: 'No', val: 'N'}], callback: function(val) { alert('Your selection: ' + val); }});</pre>
      </li>
      <li>
        <a id="yes-no-cancel-buttons">Message with custom buttons (yes/no/cancel) with style classes.</a>
        <pre class="code">new Messi('This is a message with Messi with custom buttons.', {title: 'Buttons', buttons: [{id: 0, label: 'Yes', val: 'Y', class: 'btn-success'}, {id: 1, label: 'No', val: 'N', class: 'btn-danger'}, {id: 2, label: 'Cancel', val: 'C'}]});</pre>
      </li>
    </ul>
    <p>Applying styles to title:</p>
    <ul>
      <li>
        <a id="success-title">Success title.</a>
        <pre class="code">new Messi('This is a message with Messi.', {title: 'Title', titleClass: 'success', buttons: [{id: 0, label: 'Close', val: 'X'}]});</pre>
      </li>
      <li>
        <a id="info-title">Info title.</a>
        <pre class="code">new Messi('This is a message with Messi.', {title: 'Title', titleClass: 'info', buttons: [{id: 0, label: 'Close', val: 'X'}]});</pre>
      </li>
      <li>
        <a id="error-title">Error title (animated).</a>
        <pre class="code">new Messi('This is a message with Messi.', {title: 'Title', titleClass: 'anim error', buttons: [{id: 0, label: 'Close', val: 'X'}]});</pre>
      </li>
      <li>
        <a id="warning-title">Warning title (animated).</a>
        <pre class="code">new Messi('This is a message with Messi.', {title: 'Title', titleClass: 'anim warning', buttons: [{id: 0, label: 'Close', val: 'X'}]});</pre>
      </li>
    </ul>
    <p>Other options:</p>
    <ul>
      <li>
        <a id="alert">Use Messi.alert() to launch a fast simple message.</a>
        <pre class="code">Messi.alert('This is an alert with Messi.');</pre>
      </li>
      <li>
        <a id="ask">Use Messi.ask() to launch a fast yes/no message.</a>
        <pre class="code">Messi.ask('This is a question with Messi. Do you like it?', function(val) { alert('Your selection: ' + val); });</pre>
      </li>
      <li>
        <a id="load">Use Messi.load() to show an ajax request as a message.</a>
        <pre class="code">Messi.load('login.php', {params: {user: 'demo', password: '1234'}});</pre>
      </li>
      <li>
        <a id="img">Use Messi.img() to show an image.</a>
        <pre class="code">Messi.img('messi.jpg');</pre>
      </li>
    </ul>
    
    <h3 id="setup">Setup</h3>
    <p>Messi requires <a href="http://jquery.com/" title="jQuery">jQuery</a> framework to work, so include it first of all in your project. After that:</p>
    <ol>
      <li>Download <strong>Messi</strong> from <a href="https://github.com/marcosesperon/Messi">gitHub</a> and descompress.</li>
      <li>Copy messi.css and messi.js files (or minified version) to your project folder.</li>
      <li>Edit you html pages to include both files:<pre>&lt;link rel="stylesheet" href="messi.min.css" /&gt;
&lt;script src="messi.js"&gt;&lt;/script&gt;</pre></li>
      <li>Enjoy it!</li>
    </ol>
    
    
    <script src="scripts/messi.js"></script>
  <script>
    jQuery.noConflict ();
    (function($) {
      $(document).ready(function() {
        
        $('#show-hide-code').on('click', function() {
          $('.code').toggle();
        });
        
        // Examples:
        
        $('#simple').on('click', function() {
          new Messi('This is a message with Messi.');
        });
        
        $('#title').on('click', function() {
          new Messi('This is a message with Messi.', {title: 'Title'});
        });
        
        $('#modal').on('click', function() {
          new Messi('This is a message with Messi in modal view. Now you can\'t interact with other elements in the page until close this.', {title: 'Modal Window', modal: true});
        });
        
        $('#absolute').on('click', function() {
          new Messi('This is a message with Messi in absolute position.', {center: false, viewport: {top: '760px', left: '0px'}});
        });
        
        $('#close-button').on('click', function() {
          new Messi('This is a message with Messi with custom buttons.', {title: 'Buttons', buttons: [{id: 0, label: 'Close', val: 'X'}]});
        });
        
        $('#yes-no-buttons').on('click', function() {
          new Messi('This is a message with Messi with custom buttons.', {title: 'Buttons', buttons: [{id: 0, label: 'Yes', val: 'Y'}, {id: 1, label: 'No', val: 'N'}], callback: function(val) { alert('Your selection: ' + val); }});
        });
        
        $('#yes-no-cancel-buttons').on('click', function() {
          new Messi('This is a message with Messi with custom buttons.', {title: 'Buttons', buttons: [{id: 0, label: 'Yes', val: 'Y', "class": 'btn-success'}, {id: 1, label: 'No', val: 'N', "class": 'btn-danger'}, {id: 2, label: 'Cancel', val: 'C'}]});
        });
        
        $('#success-title').on('click', function() {
          new Messi('This is a message with Messi.', {title: 'Title', titleClass: 'success', buttons: [{id: 0, label: 'Close', val: 'X'}]});
        });
        
        $('#info-title').on('click', function() {
          new Messi('This is a message with Messi.', {title: 'Title', titleClass: 'info', buttons: [{id: 0, label: 'Close', val: 'X'}]});
        });
        
        $('#error-title').on('click', function() {
          new Messi('This is a message with Messi.', {title: 'Title', titleClass: 'anim error', buttons: [{id: 0, label: 'Close', val: 'X'}]});
        });
        
        $('#warning-title').on('click', function() {
          new Messi('This is a message with Messi.', {title: 'Title', titleClass: 'anim warning', buttons: [{id: 0, label: 'Close', val: 'X'}]});
        });
        
        $('#alert').on('click', function() {
          Messi.alert('This is an alert with Messi.');
        });
        
        $('#ask').on('click', function() {
          Messi.ask('This is a question with Messi. Do you like it?', function(val) { alert('Your selection: ' + val); });
        });
        
        $('#load').on('click', function() {
          Messi.load('ajax.html');
        });
        
        $('#img').on('click', function() {
          Messi.img('messi.jpg');
        });
        
      });
    })(jQuery);
  </script>
  </html> 
