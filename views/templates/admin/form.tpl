<div class="panel">
	<div class="panel-heading">
		{l s='Import barcodes' mod='tp_import_barcodes'}
	</div>
	<p>
		{l s='Thank you for choosing our module' mod='tp_import_barcodes'} :)
	</p>
	<p>
		<b>{l s='How to use the module?' mod='tp_import_barcodes'}</b>
		<ol>
			<li>
                {l
                    s='Create an xlsx file that contains in the first row the product id and in the second the barcode.'
                    mod='tp_import_barcodes'
                }
                <br>
                <i>
                    {l
                        s='Keep in mind that the first row will be ignored (because usually it is devoted to the column
                        names).'
                        mod='tp_import_barcodes'
                    }
                </i>
                <br>
                <i>
                    {l
                        s='You can have more columns for your convenience, but only these two will be taken into
                        consideration.'
                        mod='tp_import_barcodes'
                    }
                </i>
                <br>
                <i>
                    {l
                        s='In case the barcode is not in the second column, you have to tell us where it is located.'
                        mod='tp_import_barcodes'
                    }
                </i>
                <br>
                <i>
                    {l
                        s='Never forget that the index should be the column minus one. Eg: Third column.'
                        mod='tp_import_barcodes'
                    } = 3 - 1 = 2
                </i>
			<li>{l s='Upload' mod='tp_import_barcodes'}</li>
		</ol>
	</p>
	<p>
		{l
            s='If you have any issues, ideas or just want to say hello, feel free to contact us via'
            mod='tp_import_barcodes'
        }
        <a href="https://fb.me/tapanda.gr" target="_blank">
            {l
                s='our fanpage'
                mod='tp_import_barcodes'
            }
        </a>.
	</p>
    <p>
        {l s='Best regards' mod='tp_import_barcodes'},<br>
		{l s='tapanda.gr team' mod='tp_import_barcodes'}
    </p>
</div>

<div class="panel">
	<div class="panel-heading">
		{l s='Import file' mod='tp_import_barcodes'}
	</div>
	<form method="post" enctype="multipart/form-data" class="form-horizontal">
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-5" style="padding-top:0">
					{l s='File' mod='tp_import_barcodes'}
				</label>
				<div class="col-lg-6 ">
					<div class="input-group">
						<input type="file" name="file">
					</div>
				</div>
			</div>
            <div class="form-group">
				<label class="control-label col-lg-5">
					{l s='Index' mod='tp_import_barcodes'}
				</label>
				<div class="col-lg-6 ">
					<div class="input-group">
						<input type="text" name="barcode_index">
					</div>
                    <p class="help-block">
						{l
                            s='If barcode column is not the second one (index = 1), please insert the respective index.'
                            mod='tp_import_barcodes'
                        }
                    </p>
				</div>
			</div>
		</div>
	    <div class="panel-footer">
		    <button type="submit" class="btn btn-default pull-right" name="submitFile">
			    <i class="process-icon-save"></i>
			    {l s='Upload' mod='tp_import_barcodes'}
		    </button>
	    </div>
	</form>
</div>

<div class="panel">
	<div class="panel-heading">
		{l s='Override barcode size' mod='tp_import_barcodes'}
	</div>
	<form method="post" class="form-horizontal">
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-5">
					{l s='Barcode size' mod='tp_import_barcodes'}
				</label>
				<div class="col-lg-6 ">
					<div class="input-group">
						<input type="text" name="size">
					</div>
                    <p class="help-block">
						{l
                            s='Insert an unsigned integer number to modify the maximum digits the upc barcode
                            field may have.'
                            mod='tp_import_barcodes'
                        }
                    </p>
				</div>
			</div>
		</div>
	    <div class="panel-footer">
		    <button type="submit" class="btn btn-default pull-right" name="submitOverride">
			    <i class="process-icon-save"></i>
			    {l s='Override' mod='tp_import_barcodes'}
		    </button>
	    </div>
	</form>
</div>