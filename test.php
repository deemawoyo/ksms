
<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>Read-only cells - Handsontable</title>

  <!--
  Loading Handsontable (full distribution that includes all dependencies apart from jQuery)
  -->
  <script data-jsfiddle="common" src="js/jquery.min.js"></script>
  <script data-jsfiddle="common" src="js/jquery.handsontable.full.js"></script>
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="styles/jquery.handsontable.full.css">

  <!--
  Loading demo dependencies. They are used here only to enhance the examples on this page
  -->
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="css/samples.css">
  <script src="js/samples.js"></script>
  <script src="js/highlight/highlight.pack.js"></script>
  <link rel="stylesheet" media="screen" href="js/highlight/styles/github.css">

  <!--
  Facebook open graph. Don't copy this to your project :)
  -->
  <meta property="og:title" content="Read-only cells">
  <meta property="og:description"
        content="This example shows how to set up read-only cells">
  <meta property="og:url" content="http://handsontable.com/demo/autocomplete.html">
  <meta property="og:image" content="http://handsontable.com/demo/image/og-image.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="409">
  <meta property="og:image:height" content="164">
  <link rel="canonical" href="http://handsontable.com/demo/autocomplete.html">

  <!--
  Google Analytics for GitHub Page. Don't copy this to your project :)
  -->
  <script src="js/ga.js"></script>

  <script data-jsfiddle="common">
    $(document).ready(function () {
      $('button[name=dumpToConsole]').on('click', function () {
        var dump = $(this).data('dump');
        var $container = $(dump);
        console.log('data of ' + dump, $container.handsontable('getData'));
      });
    });

    function getCarData() {
      return [
        {car: "Nissan", year: 2009, chassis: "black", bumper: "black"},
        {car: "Nissan", year: 2006, chassis: "blue", bumper: "blue"},
        {car: "Chrysler", year: 2004, chassis: "yellow", bumper: "black"},
        {car: "Volvo", year: 2012, chassis: "white", bumper: "gray"}
      ];
    }
  </script>
</head>

<body>
<a href="http://github.com/warpech/jquery-handsontable" class="forkMeOnGitHub">Fork me on GitHub</a>

<div id="container">
  <div class="columnLayout">

    <div class="rowLayout">
      <div class="descLayout">
        <div class="pad">
          <h1><a href="../index.html">Handsontable</a></h1>

          <div class="tagline">a minimalistic Excel-like <span class="nobreak">data grid</span> editor
            for HTML, JavaScript &amp; jQuery
          </div>

          <h2>Read-only cells</h2>

          <p>This page shows ways to configure columns or cells to be read only:</p>

          <ul>
            <li><a href="#columns">Read-only columns</a></li>
            <li><a href="#cells">Read-only specific cells</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="rowLayout">
      <div class="descLayout">
        <div class="pad" data-jsfiddle="example1">
          <a name="columns"></a>

          <h2>Read-only columns</h2>

          <p>In many usage cases, you will need to configure a certain column to be read only. This column will be
            available for keyboard navigation and CTRL+C. Only editing and pasting data will be disabled.</p>

          <p>To make a column read-only, declare it in the <code>columns</code> setting. You can also define a special
            renderer function that will dim the read-only values.</p>

          <div id="example1"></div>

          <p>
            <button name="dump" data-dump="#example1" title="Prints current data source to Firebug/Chrome Dev Tools">
              Dump data to console
            </button>
          </p>
        </div>
      </div>

      <div class="codeLayout">
        <div class="pad">
          <div class="jsFiddle">
            <button class="jsFiddleLink" data-runfiddle="example1">Edit in jsFiddle</button>
          </div>

          <script data-jsfiddle="example1">
            $(document).ready(function () {
              $("#example1").handsontable({
                data: getCarData(),
                minSpareRows: 1,
                colHeaders: ["Car", "Year", "Chassis color", "Bumper color"],
                columns: [
                  {
                    data: "car",
                    readOnly: true
                  },
                  {
                    data: "year"
                  },
                  {
                    data: "chassis"
                  },
                  {
                    data: "bumper"
                  }
                ]
              });
            });
          </script>
        </div>
      </div>
    </div>

    <div class="rowLayout">
      <div class="descLayout">
        <div class="pad" data-jsfiddle="example2">
          <a name="cells"></a>

          <h2>Read-only specific cells</h2>

          <p>This example makes cells that contain the word "Nissan" read only.</p>

          <p>It forces all cells to be rendered by <code>myReadonlyRenderer</code>, which will decide wheather a cell is
            really read only by checking its <code>readOnly</code> property.</p>

          <div id="example2"></div>

          <p>
            <button name="dump" data-dump="#example2" title="Prints current data source to Firebug/Chrome Dev Tools">
              Dump data to console
            </button>
          </p>
        </div>
      </div>

      <div class="codeLayout">
        <div class="pad">
          <div class="jsFiddle">
            <button class="jsFiddleLink" data-runfiddle="example2">Edit in jsFiddle</button>
          </div>

          <script data-jsfiddle="example2">
            $(document).ready(function () {
              $("#example2").handsontable({
                data: getCarData(),
                minSpareRows: 1,
                colHeaders: ["Car", "Year", "Chassis color", "Bumper color"],
                cells: function (row, col, prop) {
                  var cellProperties = {};
                  if ($("#example2").handsontable('getData')[row][prop] === 'Nissan') {
                    cellProperties.readOnly = true;
                  }
                  return cellProperties;
                }
              });
            });
          </script>
        </div>
      </div>
    </div>

    <div class="rowLayout">
      <div class="descLayout noMargin">
        <div class="pad"><p>For more examples, head back to the <a href="../index.html">main page</a>.</p>

          <p class="small">Handsontable &copy; 2012 Marcin Warpechowski and contributors.<br> Code and documentation
            licensed under the The MIT License.</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
