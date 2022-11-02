<link href="{{ URL::asset('css/factura.css'); }}" rel="stylesheet">
<div class="modal fade show " id="modal" style="display:block">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">SOLICITUD</h4>
        <button type="button" class="close" data-dismiss="modal" style="font-size: 24px;" onclick="closeModal()">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="overflow-y: auto;overflow-x: auto;">
        <div class="row">
                <div class="col-sm-12">
                    @include("../operaciones/confirmaciones/mails/curso_status")
                </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-modal" data-dismiss="modal" style="margin-left:5px;"  onclick="print()"><i class="fa fa-save"></i> Imprimir</button>
        <button type="button" class="btn btn-primary btn-modal" data-dismiss="modal" style="margin-left:5px;" onclick="confirmSinCorreo()"><i class="fa fa-user"></i> Confirmar</button>
        <button type="button" class="btn btn-success btn-modal" data-dismiss="modal" style="margin-left:5px;" onclick="send()"><i class="fa fa-send"></i> Envíar correo</button>
        <button type="button" class="btn btn-danger btn-modal" data-dismiss="modal">x</button>
      </div>

    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>
  <script src="{{ URL::asset('js/operaciones/modales/header.js'); }}"></script>  
<script src="{{ URL::asset('js/operaciones/modales/solicitud_curso.js'); }}"></script>  

<?php $route_modal = route("confirmaciones.index");?>
<input type="hidden" value="{{$route_modal}}" id="route_modal" />
<input type="hidden" value="{{$id}}" id="id" />
