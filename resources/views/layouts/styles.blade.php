 <!--  Fonts and icons     -->
<!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
<!--<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">

<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<style lang="css">
     @-webkit-keyframes spin {
        0%{
            transform:rotate(0)
        }
        100%{
            transform:rotate(360deg)
        }
    }
    @-moz-keyframes spin {
        0%{
            -moz-transform:rotate(0)
        }
        100%{
            -moz-transform:rotate(360deg)
        }
    }
    @keyframes spin {
        0%{
            transform:rotate(0)
        }
        100%{
            transform:rotate(360deg)
        }
    }
    .spinner {
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        z-index:1003;
        background: #EEEEEE;
        overflow:hidden
    }
    .spinner div:first-child {
        display:block;
        position:relative;
        left:50%;
        top:50%;
        width:150px;
        height:150px;
        margin:-75px 0 0 -75px;
        border-radius:50%;
        box-shadow:0 3px 3px 0 rgba(255,56,106,1);
        transform:translate3d(0,0,0);
        animation:spin 2s linear infinite
    }
    .spinner div:first-child:after,
    .spinner div:first-child:before {
        content:'';
        position:absolute;
        border-radius:50%
    }
    .spinner div:first-child:before {
        top:5px;l
        eft:5px;
        right:5px;
        bottom:5px;
        box-shadow:0 3px 3px 0 rgb(255, 228, 32);
        -webkit-animation:spin 3s linear infinite;
        animation:spin 3s linear infinite
    }
    .spinner div:first-child:after {
        top:15px;
        left:15px;
        right:15px;
        bottom:15px;
        box-shadow:0 3px 3px 0 rgba(61, 175, 255,1);
        animation:spin 1.5s linear infinite
    }
</style>
<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
