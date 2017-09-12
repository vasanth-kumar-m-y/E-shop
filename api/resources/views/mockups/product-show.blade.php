@extends('mockups.layout')


@section('head.post')
@parent
    <link rel="stylesheet" href="/bower_components/blueimp-gallery-with-desc/css/blueimp-gallery.min.css"/>
@endsection


@section('body.post')
@parent
    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery">
        <div class="slides"> </div> <h3 class="title"> </h3> <a class="prev"> ‹ </a> <a class="next"> › </a> <a class="close"> × </a> <a class="play-pause"> </a> <ol class="indicator"> </ol>
    </div>
    <script src="/bower_components/blueimp-gallery-with-desc/js/blueimp-gallery.min.js">
    </script>
    <script>
        document.getElementById('links').onclick = function (event) {
            event = event || window.event;
            var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event},
            links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        };
        blueimp.Gallery(
        document.getElementById('links').getElementsByTagName('a'),
        {
            container: '#blueimp-gallery-carousel',
            carousel: true
        }
        );
    </script>    
@endsection


@section('content')
<div  id="product-show" >
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li> <a href="#"> Home </a> </li>
                <li> <a href="#"> Library </a> </li>
                <li class="active"> Data </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div id="titles" class="panel panel-default">
                <div class="panel-body">
                    <h1 id="title">
                        Title
                    </h1>
                    <p id="summary">
                        Summary middle text long
                    </p>
                </div>
            </div>
            <div id="photos" class="panel panel-default">
                <div class="panel-heading">
                    Photos
                </div>
                <div class="panel-body">
                    <div id="links">
                        <a href="https://farm6.static.flickr.com/5697/23965829792_1a501bc8b4_b.jpg" title="Banana" data-gallery>
                            <img src="https://farm6.static.flickr.com/5697/23965829792_1a501bc8b4_s.jpg" alt="Banana"/>
                        </a>
                        <a href="https://farm6.static.flickr.com/5678/23459888004_a3787d3c13_b.jpg" title="Apple" data-gallery>
                            <img src="https://farm6.static.flickr.com/5678/23459888004_a3787d3c13_s.jpg" alt="Apple"/>
                        </a>                      
                    </div>
                </div>
            </div>
            <div id="description" class="panel panel-default">
                <div class="panel-heading">
                    Content
                </div>
                <div class="panel-body">
                    @include('mockups.product-show-description');
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="actions" class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline">
                        <div class="form-row">
                            <label for="exampleInputName2">
                                Price
                            </label>
                            ($)
                            <p id="price">
                                158.55
                            </p>
                        </div>
                        <div class="form-row">
                            <label for="quantity">
                                Quantity
                            </label>
                            <select name="quantity">
                                <option value="1">
                                    1
                                </option>
                                <option value="2">
                                    2
                                </option>
                                <option value="3">
                                    3
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-lg btn-fav">
                        <span class="glyphicon glyphicon-heart-empty" aria-hidden="true">
                        </span>
                    </button>
                    <button type="button" class="btn btn-lg btn-warning">
                        <span class="glyphicon glyphicon-link" aria-hidden="true">
                        </span>
                        Share
                    </button>
                    <button type="button" class="btn btn-lg btn-primary">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true">
                        </span>
                        Buy
                    </button>
                </div>
            </div>
            <div id="short-info" class="panel panel-default">
                <div class="panel-heading">
                    Short Info
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="title">
                                Date published:
                            </span>
                            <span class="content">
                                Cras justo odio
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="title">
                                Date ends:
                            </span>
                            <span class="content">
                                Cras justo odio
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="title">
                                Categories:
                            </span>
                            <span class="content">
                                <span class="label label-default">
                                    New
                                </span>
                                <span class="label label-default">
                                    New
                                </span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection