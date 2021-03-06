<?php
/**
 * This view displays the counters (number of available leave) for an employee.
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license      http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link            https://github.com/bbalet/jorani
 * @since         0.2.0
 */
?>

<div class="row-fluid">
    <div class="span12">

<h2><?php echo lang('leaves_summary_title');?><?php echo $help;?></h2>

    <p><?php echo lang('leaves_summary_date_field');?>&nbsp;
        <input type="text" id="refdate" />
    </p>

<table class="table table-bordered table-hover">
<thead>
    <tr>
      <th><?php echo lang('leaves_summary_thead_type');?></th>
      <th><?php echo lang('leaves_summary_thead_available');?></th>
      <th><?php echo lang('leaves_summary_thead_taken');?></th>
      <th><?php echo lang('leaves_summary_thead_entitled');?></th>
    </tr>
  </thead>
  <tbody>
  <?php if (count($summary) > 0) {
  foreach ($summary as $key => $value) {
      if ($value[2] == '') {?>
    <tr>
      <td><?php echo $key; ?></td>
      <td><?php echo round(((float) $value[1] - (float) $value[0]), 3, PHP_ROUND_HALF_DOWN); ?></td>
      <td><?php echo ((float) $value[0]); ?></td>
      <td><?php echo ((float) $value[1]); ?></td>
    </tr>
  <?php }
    }
  } else {?>
    <tr>
      <td colspan="4"><?php echo lang('leaves_summary_tbody_empty');; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<?php if ($this->config->item('disable_overtime') == FALSE) { ?>
<h4><?php echo lang('leaves_summary_title_overtime');?></h4>

<table id="overtime" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
<thead>
    <tr>
      <th><?php echo lang('leaves_summary_thead_type');?></th>
      <th><?php echo lang('leaves_summary_thead_entitled');?></th>
      <th><?php echo lang('leaves_summary_thead_description');?></th>
    </tr>
  </thead>
  <tbody>
  <?php if (count($summary) > 0) {
  foreach ($summary as $key => $value) {
      if ($value[2] != '') {?>
    <tr>
      <td><?php echo str_replace("Catch up for", lang('leaves_summary_key_overtime'), $key); ?></td>
      <td><?php echo (float) $value[1]; ?></td>
      <td><?php echo $value[2]; ?></td>
    </tr>
  <?php }
    }
  } else {?>
    <tr>
      <td colspan="4"><?php echo lang('leaves_summary_tbody_empty');; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php } ?>

        </div>
</div>

<div class="row-fluid"><div class="span12">&nbsp;</div></div>

<link href="<?php echo base_url();?>assets/datatable/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/flick/jquery-ui.custom.min.css">

<script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
<?php //Prevent HTTP-404 when localization isn't needed
if ($language_code != 'en') { ?>
<script src="<?php echo base_url();?>assets/js/i18n/jquery.ui.datepicker-<?php echo $language_code;?>.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/moment-with-locales.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function () {
        //Init datepicker widget (it is complicated because we cannot based it on UTC)
        isDefault = <?php echo $isDefault;?>;
        moment.locale('<?php echo $language_code;?>', {longDateFormat : {L : '<?php echo lang('global_date_momentjs_format');?>'}});
        reportDate = '<?php $date = new DateTime($refDate); echo $date->format(lang('global_date_format'));?>';
        todayDate = moment().format('L');
        if (isDefault == 1) {
            $("#refdate").val(todayDate);
        } else {
            $("#refdate").val(reportDate);
        }
        $('#refdate').datepicker({
            dateFormat: '<?php echo lang('global_date_js_format');?>',
            onSelect: function(dateText, inst) {
                    tmpUnix = moment($("#refdate").datepicker("getDate")).unix();
                    url = "<?php echo base_url();?>leaves/counters/" + tmpUnix;
                    window.location = url;
            }
        });
        
    //Transform the HTML table in a dynamic datatable
    $('#overtime').dataTable({
	"oLanguage": {
                    "sEmptyTable":     "<?php echo lang('datatable_sEmptyTable');?>",
                    "sInfo":           "<?php echo lang('datatable_sInfo');?>",
                    "sInfoEmpty":      "<?php echo lang('datatable_sInfoEmpty');?>",
                    "sInfoFiltered":   "<?php echo lang('datatable_sInfoFiltered');?>",
                    "sInfoPostFix":    "<?php echo lang('datatable_sInfoPostFix');?>",
                    "sInfoThousands":  "<?php echo lang('datatable_sInfoThousands');?>",
                    "sLengthMenu":     "<?php echo lang('datatable_sLengthMenu');?>",
                    "sLoadingRecords": "<?php echo lang('datatable_sLoadingRecords');?>",
                    "sProcessing":     "<?php echo lang('datatable_sProcessing');?>",
                    "sSearch":         "<?php echo lang('datatable_sSearch');?>",
                    "sZeroRecords":    "<?php echo lang('datatable_sZeroRecords');?>",
                    "oPaginate": {
                        "sFirst":    "<?php echo lang('datatable_sFirst');?>",
                        "sLast":     "<?php echo lang('datatable_sLast');?>",
                        "sNext":     "<?php echo lang('datatable_sNext');?>",
                        "sPrevious": "<?php echo lang('datatable_sPrevious');?>"
                    },
                    "oAria": {
                        "sSortAscending":  "<?php echo lang('datatable_sSortAscending');?>",
                        "sSortDescending": "<?php echo lang('datatable_sSortDescending');?>"
                    }
                }
            });
    });
</script>
