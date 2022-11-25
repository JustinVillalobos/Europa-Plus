<link href="{{ URL::asset('css/factura.css'); }}" rel="stylesheet">
<div class="modal fade  " id="modal_factura" style="display:">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <div class="col-sm-9">
          <h4 class="modal-title">FACTURA</h4>
        </div>
        <div class="col-sm-3 d-flex justify-content-end">
          <button class="btn btn-primary"style="font-size: 24px;" onclick="editar()"><i class="fa fa-edit"></i></button>
          <button type="button" class="close" data-dismiss="modal" style="font-size: 24px;margin-left:0" onclick="closeModalFactura()">&times;</button>
        </div>
        
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="overflow-y: auto;overflow-x: auto;">
        <div class="row">
                <div class="col-sm-12">
                    @include("../operaciones/confirmaciones/mails/factura")
                </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      
        <button type="button" class="btn btn-warning btn-modal" data-dismiss="modal" style="margin-left:5px;"  onclick="sendFactura()"><i class="fa fa-save"></i> Envíar</button>
        <button type="button" class="btn btn-primary btn-modal" data-dismiss="modal" style="margin-left:5px;"  onclick="printFactura(true)"><i class="fa fa-save"></i> Imprimir</button>
        <button type="button" class="btn btn-danger btn-modal" data-dismiss="modal"  onclick="closeModalFactura()">x</button>
      </div>

    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>
  <script src="{{ URL::asset('js/operaciones/modales/header.js'); }}"></script>  

<?php $route_modal = route("reporte.index");?>
<input type="hidden" value="{{$route_modal}}" id="route_modal" />
<input type="hidden" value="" id="id" />
