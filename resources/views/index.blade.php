<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>URL Shortener</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
    <link href="{{ asset('css/mainCSS.css') }}" rel="stylesheet">
    <style>
    #cover {
        background: #222 url('img/img2.jpg') center center no-repeat;
        background-size: cover;
        height: 100%;
        text-align: center;
        display: flex;
        align-items: center;
        position: relative;
    }

    #cover-caption {
        width: 100%;
        position: relative;
        z-index: 1;
    }

    /* only used for background overlay not needed for centering */
    .form:before {
        content: '';
        height: 100%;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: -1;
        border-radius: 10px;
    }

    #loader-container {
        width: 100%;
        height: 100vh;
        position: fixed;
        background: #000 url("https://media.giphy.com/media/8agqybiK5LW8qrG3vJ/giphy.gif") center no-repeat;
        z-index: 1;
    }

    .loader-container-hidden {
        display: none;
    }

    .loader_div {
        position: absolute;
        top: 0;
        bottom: 0%;
        left: 0;
        right: 0%;
        z-index: 99;
        opacity: 0.7;
        display: none;
        background: url("https://media.giphy.com/media/8agqybiK5LW8qrG3vJ/giphy.gif") center no-repeat;
    }

    /* #btn-link {
        position: relative;
        padding: 8px 16px;
        border: none;
        outline: none;
        border-radius: 2px;
        cursor: pointer;
    } */

    /* Using codepen button style :) */
    #btn-link {
    display: inline-block;
    border: none;
    outline: none;
    padding: 8px 15px;
    line-height: 1.2;
    background: linear-gradient(#4d4d4d,#2f2f2f);
    border-radius: 2px;
    border: 1px solid black;
    font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Sans-Serif;
    color: white !important;
    font-size: 1.1em;
    cursor: pointer;
    /* Important part */
    position: relative;
    transition: padding-right .3s ease-out;
}
#btn-link.loading {
    background-color: #CCC;
    padding-right: 40px;
}
#btn-link.loading:after {
    content: "";
    position: absolute;
    border-radius: 100%;
    right: 6px;
    top: 50%;
    width: 0px;
    height: 0px;
    margin-top: -2px;
    border: 2px solid rgba(255,255,255,0.5);
    border-left-color: #FFF;
    border-top-color: #FFF;
    animation: spin .6s infinite linear, grow .3s forwards ease-out;
}
@keyframes spin { 
    to {
        transform: rotate(359deg);
    }
}
@keyframes grow { 
    to {
        width: 14px;
        height: 14px;
        margin-top: -8px;
        right: 13px;
    }
}
    </style>
</head>

<body>
    <div id="loader-container">
        <div class="spinner"></div>
    </div>

    <section id="cover">
        <div id="cover-caption">
            <div id="container" class="container">
                <div class="row">
                    <div class="col-sm-10 offset-sm-1 text-center">
                        <h1>
                            Shorten your links.
                        </h1>

                        <p class="lead">
                            Paste a long URL below and we'll shorten it and generate QRcode for you.
                        </p>
                        <div class="info-form">
                            <div id="loader_div" class="loader_div"></div>
                            <span class="text-danger" id="link-error"></span>
                            <div class="form-inline justify-content-center form">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="text" id="link" class="form-control form-control-md"
                                            placeholder="Your long URL here" style="width:500px">

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" id="btn-link">okay, go!</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10 offset-sm-1 text-center">
                            <div class="info-form">
                                <div class="form-inline justify-content-center form">
                                    <div id="shortUrl">
                                        <!-- <div class="input-group">
                                            <input type="text" class="form-control form-control" id="copy-url"
                                                value="'+data.bitlyUrl+'" readonly>
                                            <span class="input-group-btn">
                                                <button class="btn btn-success btn" type="submit" data-clipboard-target="#copy-url">copy!</button>
                                            </span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="visible-print text-center" id="qrcode">
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                    </div>
    </section>

</body>

</html>
<script src="{{asset('jquery/jquery.min.js')}}"></script>
<script src="{{asset('jquery/jquery.qrcode.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
<script src="{{asset('js/getUrl.js')}}"></script>
<script src="{{asset('js/copyLink.js')}}"></script>

<script type="text/javascript">
const loaderContainer = document.querySelector('#loader-container');
const theButton = document.querySelector("#btn-link");
// var myVar;

// function myFunction() {
//   myVar = setTimeout(showPage, 2000);
// }

// function showPage() {
//   document.querySelector("#loader-container").style.display = "none";
//   document.querySelector("#cover").style.display = "block";
//   document.querySelector("body").style.backgroundColor = "white";
// }
window.addEventListener('load', () => {
    loaderContainer.classList.add('loader-container-hidden');
});

//just some js to simulate fake loading time

function removeClass(){  
    myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
}

var myButton = document.querySelector('.btn');


myButton.addEventListener("click", function() {
    myButton.className = myButton.className + ' loading';
    setTimeout(removeClass, 1000);
}, false);
</script>