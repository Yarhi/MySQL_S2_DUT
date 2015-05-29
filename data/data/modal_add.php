    <!--ModalAddADHERENT-->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form method="get" action="data/add.php">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="ModalLabel_title_add">Ajout de données</h4>
              <input type="hidden" name="">
            </div>
            <div id="modal_body_bef">
              <input type="hidden" name="table" id="table_add" value=""/>
              <div class="modal-body" id="modal_body_add">

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
          </div>
        </div>
      </form>
    </div>