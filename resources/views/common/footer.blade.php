@section('footer')
<footer>
<style>
.content_box{
    float:left;
    width:100%;
}
.left_bar{
    float:left;
    width:10%;
    background:#eaf4ff;
    height:100vh;
}

.right_bar{
    float:left;
    width:90%;
    padding:15px;
        /*border-left:1px solid #ccc;*/
        height:100%;
}

.nav-tabs--vertical li{
    float:left;
    width:100%;
    padding:0;
    position:relative;
}


.nav-tabs--vertical li a{
    float:left;
    width:100%;
    padding: 15px;
    border-bottom:1px solid #adcff7;
    color:#1276F0;
}

.nav-tabs--vertical li a.active::after {
    content: "";
    border-color: #1276F0;
    border-style: solid;
    position: absolute;
    right: -8px;
    /* border-top: transparent; */
    border-right: transparent;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    /*border-bottom: 16px solid #1276F0;*/
        border-bottom: 16px solid #fff;
    border-top: 0;
    transform: rotate(270deg);
    z-index:999;
}
label.radio {
    cursor: pointer
}

label.radio input {
    position: absolute;
    top: 0;
    left: 0;
    visibility: hidden;
    pointer-events: none
}

label.radio span {
    padding: 6px;
    border: 1px solid red;
    display: inline-block;
    color: red;
    width: auto;
    text-align: center;
    border-radius: 3px;
    margin-top: 7px;
}

label.radio input:checked+span {
    border-color: red;
    background-color: red;
    color: #fff
}

.ans {
    margin-left: 36px !important
}

.btn:focus {
    outline: 0 !important;
    box-shadow: none !important
}

.btn:active {
    outline: 0 !important;
    box-shadow: none !important
}
.align-items-right{
    left: 90%;
}
</style>
</footer>
</html>
@show