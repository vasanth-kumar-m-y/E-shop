@extends('mockups.layout')

@section('body.post')

<!-- tinyMCE Editor -->

<script src='/bower_components/tinymce-dist/tinymce.min.js'></script>
<script type="text/javascript">
tinymce.init({
  selector: 'textarea#description',
  height: 400,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
</script>

<!-- tag-it autocomplete -->

<script src="/bower_components/jquery-ui/ui/minified/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/bower_components/tag-it/js/tag-it.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="/bower_components/jquery-ui/themes/flick/jquery-ui.min.css">
<link href="/bower_components/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css">

<script type="text/javascript">

   $(document).ready(function() {
       $('#myTags').tagit({
        availableTags: ['sss', 'aaa'],
        allowSpaces: false,
        placeholderText: 'New category',
        autocomplete: ({
            source: function (request, response) {
                $.ajax({
                    url: '/mockup/autocomplete-categories',
                    data: { format: "json", query: request.term },
                    dataType: 'json',
                    type: 'GET',
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item,
                                value: item
                            }}));},
                        error: function (request, status, error) {
                            alert(error);
                        }})},
                minLength: 2
            })});});
</script>

<!-- Date picker -->

<script src="/bower_components/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script>
    $(function() {
        $.datepicker.setDefaults( {dateFormat: "dd/mm/yy"} );
        $( "#date-start" ).datepicker();
        $( "#date-end" ).datepicker();
    });
</script>

@endsection

@section('content')

<div id="product-edit">

    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        Home
                    </a>
                </li>
                <li class="active">
                    Product Edit
                </li>
            </ol>
        </div>
    </div>

    <h1 class="section-title">
        Product Edit
    </h1>

    <div class='col-md-10 col-md-offset-1'>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">
                    Basic
                </a>
            </li>
            <li role="presentation">
                <a href="#more" aria-controls="more" role="tab" data-toggle="tab">
                    More
                </a>
            </li>
        </ul>

        <form class="form-horizontal">

            <!-- Tab panes -->
            <div class="tab-content">

                <!-- panel basic -->

                <div role="tabpanel" class="tab-pane active" id="basic">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h2 class="col-sm-offset-1 form-title">
                                Basic Settings
                            </h2>

                            <div class="form-group has-error has-feedback">
                                <label for="inputTitle" class="col-sm-2 control-label">
                                    Title
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputTitle" placeholder="Title"/>
                                    <span id="helpBlock2" class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSubTitle" class="col-sm-2 control-label">
                                    Subtitle
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputSubTitle" placeholder="SubTitle"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputDescription" class="col-sm-2 control-label">
                                    Description
                                </label>
                                <div class="col-sm-9">
                                    <textarea id="description">
                                        <p style="text-align: center;"> <img title="TinyMCE Logo" src="//www.tinymce.com/images/glyph-tinymce@2x.png" alt="TinyMCE Logo" width="110" height="97" /> </p> <h1 style="text-align: center;">Welcome to the TinyMCE editor demo!</h1> <p> Please try out the features provided in this basic example.<br> Note that any <strong>MoxieManager</strong> file and image management functionality in this example is part of our commercial offering – the demo is to show the integration. </p> <h2>Got questions or need help?</h2> <ul> <li>Our <a href="http://www.tinymce.com/docs/">documentation</a> is a great resource for learning how to configure TinyMCE.</li> <li>Have a specific question? Visit the <a href="http://community.tinymce.com/forum/">Community Forum</a>.</li> <li>We also offer enterprise grade support as part of <a href="www.tinymce.com/pricing">TinyMCE Enterprise</a>.</li> </ul> <h2>A simple table to play with</h2> <table style="text-align: center;"> <thead> <tr> <th>Product</th> <th>Cost</th> <th>Really?</th> </tr> </thead> <tbody> <tr> <td>TinyMCE</td> <td>Free</td> <td>YES!</td> </tr> <tr> <td>Plupload</td> <td>Free</td> <td>YES!</td> </tr> </tbody> </table> <h2>Found a bug?</h2> <p> If you think you have found a bug please create an issue on the <a href="https://github.com/tinymce/tinymce/issues">GitHub repo</a> to report it to the developers. </p> <h2>Finally ...</h2> <p> Don't forget to check out our other product <a href="http://www.plupload.com" target="_blank">Plupload</a>, your ultimate upload solution featuring HTML5 upload support. </p> <p> Thanks for supporting TinyMCE! We hope it helps you and your users create great content.<br>All the best from the TinyMCE team. </p>
                                    </textarea>
                                </div>
                            </div>

                            <hr class="separator"/>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-lg btn-primary">Save All</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- panel more -->

                <div role="tabpanel" class="tab-pane" id="more">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h2 class="col-sm-offset-1 form-title">
                                More Settings
                            </h2>

                            <div class="form-group">
                                <label for="price" class="col-sm-2 control-label">
                                    Price
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input name="price" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="quantity" class="col-sm-2 control-label">
                                    Quantity
                                </label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="number" name="quantity" min="1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date-start" class="col-sm-2 control-label">
                                    Date start
                                </label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="date-start">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date-end" class="col-sm-2 control-label">
                                    Date end
                                </label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="date-end">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputCategories" class="col-sm-2 control-label">
                                    Categories
                                </label>
                                <div class="col-sm-6">
                                    <ul id="myTags">
                                        <!-- Existing list items will be pre-added to the tags -->
                                        <li>Tag1</li>
                                        <li>Tag2</li>
                                    </ul>
                                </div>
                            </div>

                            <hr class="separator"/>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-lg btn-primary">Save All</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- end panel more -->
            </div>

        </form>

    </div>


</div>

@endsection
