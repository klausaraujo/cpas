<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>
    <?=TITULO_PRINCIPAL?>
  </title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="<?=AUTOR?>">
  <?php
$this->load->view("inc/resources");
?>
  <link rel="stylesheet" href="<?=base_url()?>public/css/perfil.css" />
  <style>
    * {
	 box-sizing: border-box;
}
 .clearfix:after, .messages:after {
	 content: "";
	 display: table;
	 clear: both;
	 height: 0;
	 visibility: hidden;
}
 body {
	 background-color: #ddd;
	 padding: 40px;
}
.list__content{
  height: 560px;
  background-color: #fff;
  overflow: auto;
}
 .screen {
	 background-color: #fff;
	 height: 500px;
	 width: 100%;
   margin: auto;
   left: 0;
	 box-shadow: 0 2px 2px rgba(0, 0, 0, .2);
}
 .conversation {
	 height: calc(100% - 50px);
	 overflow: auto;
	 padding: 20px;
	 padding-bottom: 0;
}
 .messages {
	 margin-bottom: 10px;
}
 .messages--received .message {
	 float: left;
	 background-color: #ddd;
	 border-bottom-left-radius: 5px;
	 border-top-left-radius: 5px;
}
 .messages--received .message:first-child {
	 border-top-left-radius: 15px;
}
 .messages--received .message:last-child {
	 border-bottom-left-radius: 15px;
}
 .messages--sent .message {
	 float: right;
	 background-color: #337ab7;
	 color: #fff;
	 border-bottom-right-radius: 5px;
	 border-top-right-radius: 5px;
}
 .messages--sent .message:first-child {
	 border-top-right-radius: 15px;
}
 .messages--sent .message:last-child {
	 border-bottom-right-radius: 15px;
}
 .message {
	 display: inline-block;
	 margin-bottom: 2px;
	 clear: both;
	 padding: 7px 13px;
	 font-size: 14px;
	 border-radius: 15px;
	 line-height: 1.4;
}
 .message--thumb {
	 background-color: transparent !important;
	 padding: 0;
	 margin-top: 5px;
	 margin-bottom: 10px;
	 width: 20px;
	 height: 20px;
	 border-radius: 0px !important;
}
.no--padding {
  padding: 0;
}
 .text-bar {
	 height: 50px;
	 border-top: 1.5px solid #337ab7;
}
 .text-bar__field {
	 float: left;
	 width: calc(100% - 50px);
	 height: 100%;
}
 .text-bar__field input {
	 width: 100%;
	 height: 100%;
	 padding: 0 20px;
	 border: none;
	 position: relative;
	 vertical-align: middle;
	 font-size: 14px;
}
 .text-bar__thumb {
	 float: left;
	 width: 50px;
	 height: 100%;
	 padding: 10px;
}
 .text-bar__thumb:hover {
	 opacity: 0.8;
}
 .text-bar__thumb .thumb {
	 width: 100%;
	 height: 100%;
	 cursor: pointer;
}
 .thumb {
	 display: block;
}
 .anim-wiggle {
	 animation: wiggle 0.2s ease infinite;
}
 .anim-wiggle-2 {
	 animation: wiggle2 0.2s ease infinite;
}
.label__mensaje{
  padding: 18px 32px;
  background-color: #337ab7;
  color: #fff;
  height: 60px;
  border-bottom: 1px solid gray;
  text-transform: uppercase;
}
.item__user{
  width: 100%;
  font-weight: 500;
  text-transform: uppercase;
}
.item__status{
  font-size: 12px;
  font-weight: inherit;
  text-transform: uppercase;
}
.chat__content--empty {
  background-color: #fff;
  height: 560px;
  margin: auto;
  text-align: center;
  vertical-align: middle;
  line-height: 90px;
}
.list-group-item{
  display: flex;
  flex-direction: row;
}
.list-group-item svg {
  margin-right: 10px;
}
.span--online {
  color: green;
}
.span--offline {
  color: brown;
}
.user-auth-img {
  height: 45px;
  width: 45px;
  margin-right: 15px;
}
.mensajes__channel {
  float: right;
}
@media (min-width: 1025px) {
  .horizontal-nav .page-wrapper {
    padding-top: 100px;
    padding-bottom: 20px;
  }
}
 @keyframes wiggle {
	 0% {
		 transform: rotateZ(5deg);
	}
	 50% {
		 transform: rotateZ(-5deg);
	}
	 100% {
		 transform: rotateZ(5deg);
	}
}
 @keyframes wiggle2 {
	 0% {
		 transform: rotateZ(10deg);
	}
	 50% {
		 transform: rotateZ(-10deg);
	}
	 100% {
		 transform: rotateZ(10deg);
	}
}
  </style>
</head>
<body>
  <div class="wrapper theme-2-active horizontal-nav navbar-top-blue">
    <?php $this->load->view("inc/navinicio");?>
    <div class="page-wrapper" style="min-height: 710px;">
      <div class="container pt-30">
        <div class="row heading-bg">
          <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Lista de Contactos</h5>
          </div>
          <div class="col-lg-4 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="<?=base_url()?>">Inicio</a></li>
              <li class="active"><span>Inbox</span></li>
            </ol>
          </div>
          <div class="row pa-10">
            <div class="col-sm-6 no--padding">
              <ul class="list-group list__content">
                <?php foreach ($lista as $row): ?>
                <li class="list-group-item" data-id="<?=$row->Guid?>" data-nombre="<?=$row->Nombre_Usuario?>">
                  <img src="<?=base_url()?>public/images/perfil/<?=$row->avatar?>" alt="user_auth" class="user-auth-img img-circle">
                  <span class="item__user">
                    <?=$row->Nombre_Usuario?>
                    <br>
                    <span class="item__status">
                      <?php if ($row->Estado == 1) {?>
                      <span class="span--online">En linea</span>
                      <?php
                        } else {?>
                      <span class="span--offline">Fuera de linea</span>
                      <?php }?>
                    </span>
                    <span class="mensajes__channel mensajes-channel-<?=$row->Guid?> hidden">
                      <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 7.5C15 11.6421 11.6421 15 7.5 15C3.35786 15 0 11.6421 0 7.5C0 3.35786 3.35786 0 7.5 0C11.6421 0 15 3.35786 15 7.5Z"
                          fill="#7BB72E" />
                        <path d="M6.05263 7.20508H7.2159V8.10014H6.05263V9.49931H5.16649V8.10014H4V7.20508H5.16649V5.8642H6.05263V7.20508Z"
                          fill="white" />
                        <path d="M10 10H9.06874V6.1797L7.95704 6.54664V5.74074L9.90011 5H10V10Z" fill="white" />
                      </svg>
                    </span>
                  </span>
                </li>
                <?php endforeach;?>
              </ul>
            </div>
            <div class="col-sm-6 no--padding chat__content--empty">
              Debe selecionar el contacto.
            </div>
            <div class="col-sm-6 no--padding chat__content hidden">
              <div class="label__mensaje"></div>
              <div class="screen them">
                <div class="conversation">
                  <div class="messages messages--received">
                  </div>
                  <div class="messages messages--sent">
                  </div>
                </div>
                <div class="text-bar">
                  <form class="text-bar__field" id="form-message">
                    <input type="text" placeholder="Escriba el mensaje" />
                  </form>
                  <div class="text-bar__thumb">
                    <div class="thumb">
                      <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="#337ab7" fill-opacity=".75" d="M1.101 21.757L23.8 12.028 1.101 2.3l.011 7.912 13.623 1.816-13.623 1.817-.011 7.912z"></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view("inc/footer");?>
    </div>
  </div>
  <div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Cargar Imagen</h4>
        </div>
        <div class="modal-body" style="overflow: hidden;">
          <div class="col-sm-12">
            <div class="dropzone needsclick dz-clickable" id="imagenUpload">
              <div class="dz-message needsclick">Arrastre o haga click</div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    pubnubUtil = new PubNub({
      publishKey: 'pub-c-0c02c6e7-3e26-4a0c-ad95-d3e65041d04d',
      subscribeKey: 'sub-c-e13ed710-2d20-11ea-a5fd-f6d34a0dd71d'
    });
  </script>
  <script>
    var URI = "<?=base_url()?>"
    var id = "<?=$Codigo_Usuario_Registro?>"
    var uuid = "<?=$uuid?>";
    var listaDetalle = JSON.parse('<?=$listaDetalle?>');
  </script>
  <script src="<?=base_url()?>public/js/usuarios/message.js"></script>
</body>
</html>