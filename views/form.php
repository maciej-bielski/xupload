<!-- The file upload form used as target for the file upload widget -->
<?php if ($this->showForm) echo CHtml::beginForm($this -> url, 'post', $this -> htmlOptions);?>
<div class="row fileupload-buttonbar">
	<div class="span7">
		<!-- The fileinput-button span is used to style the file input field as button -->
		<span class="btn btn-success fileinput-button">
            <i class="icon-plus icon-white"></i>
            <span><?php echo $this->t('1#Dodaj pliki|0#Choose file', $this->multiple); ?></span>
			<?php
            if ($this -> hasModel()) :
                echo CHtml::activeFileField($this -> model, $this -> attribute, $htmlOptions) . "\n";
            else :
                echo CHtml::fileField($name, $this -> value, $htmlOptions) . "\n";
            endif;
            ?>
		</span>
        <?php if ($this->multiple) { ?>
		<button type="submit" class="btn btn-primary start">
			<i class="icon-upload icon-white"></i>
			<span>Załaduj wszystko</span>
		</button>
		<button type="reset" class="btn btn-warning cancel">
			<i class="icon-ban-circle icon-white"></i>
			<span>Anuluj wczytywanie</span>
		</button>
		<button type="button" class="btn btn-danger delete">
			<i class="icon-trash icon-white"></i>
			<span>Usuń Zaznaczone</span>
		</button>
		<input type="checkbox" class="toggle">
        <?php } ?>
	</div>
	<div class="span5">
		<!-- The global progress bar -->
		<div class="progress progress-success progress-striped active fade">
			<div class="bar" style="width:0%;"></div>
		</div>
	</div>
</div>
<!-- The loading indicator is shown during image processing -->
<div class="fileupload-loading"></div>
<br>
<!-- The table listing the files available for upload/download -->
<table class="table table-striped">
	<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">
    <?php foreach($this->model->getAllFiles() as $file): ?>
        <?php if ($file == '.' || $file == '..') continue;?>
        <tr class="template-download fade in" style="height: 60px;">

            <td class="preview">
                <a href="<?= $this->model->urlPrefix . $file ?>" title="<?= $file ?>" rel="gallery" download="<?= $file ?>"><img style="width:80px;height:auto;" src="<?= $this->model->urlPrefix . $file ?>"></a>
            </td>
            <td class="name">
                <a href="<?= $this->model->urlPrefix . $file ?>" title="<?= $file ?>" rel="gallery" download="<?= $file ?>"><?= $file ?></a>
            </td>
            <td class="size"><span></span></td>
            <td colspan="2"></td>

            <td class="delete">
                <button class="btn btn-danger" data-type="POST" data-url="/<?= isset(Yii::app()->controller->module) ? Yii::app()->controller->module->id . '/' : '' ?><?= Yii::app()->controller->id ?>/uploadImages/_method/delete/file/<?= urlencode($file) ?>/id/<?= $_GET['id'] ?>/controller/<?= Yii::app()->controller->id ?>">
                    <i class="icon-trash icon-white"></i>
                    <span>Usuń</span>
                </button>
                <input type="checkbox" name="delete" value="1">
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php if ($this->showForm) echo CHtml::endForm();?>
