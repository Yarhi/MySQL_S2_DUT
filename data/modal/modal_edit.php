    <!--MODAL EDIT-->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form method="get" action="data/op/edit.php">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="ModalLabel_title">Edition ligne</h4>
              <div id="nb_col" style="display:none;"><?=$req_table->columnCount()?></div>
            </div>
            <div class="modal-body">
              <div id="modal_body_edit">

              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="table" value="<?=$table?>">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Editer</button>
            </div>
          </div>
        </div>
      </form>
    </div>