    <!--MODAL DELETE-->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form method="get" action="data/op/delete.php">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="ModalLabel_title_del">Suppression ligne </h4>
              <div id="nb_col" style="display:none;"><?=$req_table->columnCount()?></div>
            </div>
            <div class="modal-body">
              Etes vous sûr de vouloir supprimer la ligne ?
              <input type="hidden" value="<?=$table?>" name="table" />
              <input type="hidden" value="" id="delete_id" name="id" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
              <button type="submit" class="btn btn-primary">Oui</button>
            </div>
          </div>
        </div>
      </form>
    </div>