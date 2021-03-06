<?php


	require_once 'init.php';
	require_once 'auth.php';
/*
 * ADDED BY : 566
 * BELOW IS TO DEFINE PATH FOR SMARTY TEMPLATE ENGINE
 */
$smarty_path   = 'D:/localhost/depkes2/smarty/libs/Smarty.class.php';
$template_path = 'D:/localhost/depkes2/templates/';
$compile_path  = 'D:/localhost/depkes2/templates_c/';

if (class_exists('sp_controller')) {
	// do nothing
} else if (defined('CLASS_sp_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_sp_CONTROLLER', TRUE);

#include_once 'class.sp.inc.php';
class sp_controller extends depkes2_manager {
	var $sp_label;
	var $optional_arr;
	function sp_controller() {
		$this->sp_label = array (
			'id_sp' => 'id_sp',
			'nomor_menteri' => 'NOMOR',
			'tanggal_menteri' => 'TANGGAL',
			'nomor_surat' => 'Nomor',
			'lampiran_surat' => 'Lampiran',
			'alamat_pabrik' => 'Alamat Pabrik',
			'date_surat' => 'Tanggal Surat',
			'no_pemohon' => 'Nomor Pemohon',
			'date_pemohon' => 'Tgl Pemohon',
			'id_cek_1' => 'Nama Pabrik',
			'kepada_surat' => 'Kepada Yth',
   			'alat' => 'Alat',
			'nomor_surat_tambahan' => 'Nomor Surat Tambahan',
			'lampiran_surat_tambahan' => 'Lampiran Surat Tambahan',
			'date_surat_tambahan' => 'Tanggal Surat Tambahan',
			'di_surat' => 'di',
			'header' => 'Header',
			'isi_1' => '1.',
			'nama_pabrik' => 'Nama Pabrik',
			'id_st'=>'Nomor Surat Tambahan Data',
			'isi_2' => '2.',
			'isi_3' => '3.',
			'isi_4' => '4.',
			'isi_5' => '5.',
			'footer' => 'Footer',
			'nama' => 'Nama Pengesah',
			'nip' => 'NIP Pengesah',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_sp' => FALSE,
			'passwd' => FALSE,
			'name' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	// create add sp form
	function add_sp_form() {
		include_once 'class.xform.inc.php';

//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;

		/*
		 * ADDED BY : 566
		 */
		$sql_nama_direktur_jenderal = "SELECT * FROM nama_direktur LIMIT 1";
		$rs_nama_direktur_jenderal  = $adodb->Execute($sql_nama_direktur_jenderal);
		$nama_direktur_jenderal     = $rs_nama_direktur_jenderal->fields['nama'];
		$nip_direktur_jenderal      = $rs_nama_direktur_jenderal->fields['nip'];

		$record = $_GET;
		$label_arr = $this->sp_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('nomor_surat','C','255');
		$field_arr[] = xform::xf('lampiran_surat','C','255');
		$field_arr[] = xform::xf('date_surat','C','255');

//		if (! $this->get_permission('fill_this')) return $this->intruder();

		$field_arr[] = xform::xf('id_cek_1','N','8');
		$field_arr[] = xform::xf('nama','C','255');
		$field_arr[] = xform::xf('nip','C','255');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');



		$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_table]." sp WHERE id_sp='{$record['id_sp']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_sp'] = 'protect';
			$mode = 'edit';
			$optional_arr['passwd_rule'] = '';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}

                $optional_arr['nama'] = 'protect';
                $optional_arr['nip'] = 'protect';

		/*
		 * Modified By : 566
		 *
		 * BEFORE :
		 *   if (! $value_arr['nama']) $value_arr['nama'] = "DRS. H. TATO SUPRAPTO BASIR, APT.MM.";
		 *   if (! $value_arr['nip']) $value_arr['nip'] = "140 086 626";
		 *
		 * AFTER :
		 */
		$value_arr['nama'] = $nama_direktur_jenderal;
		$value_arr['nip'] = $nip_direktur_jenderal;
		
		$optional_arr['name_rule'] = '';
		$optional_arr['nomor_surat_rule'] = '';
		$optional_arr['lampiran_surat_rule'] = '';
		$optional_arr['date_surat_rule'] = '';
		$optional_arr['kepada_surat_rule'] = '';
  		$optional_arr['alat_rule'] = '';
		$optional_arr['di_surat_rule'] = '';
		$optional_arr['header_rule'] = '';
		$optional_arr['isi_1_rule'] = '';
		$optional_arr['isi_2_rule'] = 'adi';
		$optional_arr['isi_3_rule'] = '';
		$optional_arr['isi_4_rule'] = '';
		$optional_arr['isi_5_rule'] = '';
		$optional_arr['footer_rule'] = '';
		$optional_arr['nama_rule'] = '';
		$optional_arr['nip_rule'] = '';
		$optional_arr['insert_by_rule'] = '';
		$optional_arr['date_insert_rule'] = '';

		eval($this->save_config);

		$optional_arr['id_cek_1'] = 'user_defined';
                $arr = array();
                $arr['name'] = 'id_cek_1';
                $arr['selected'] = $value_arr['id_cek_1'];

		if($mode=='add'){
                	$arr['sql'] = '
			SELECT
				cek.id_cek_1 as val,
    				pendaftar.nama_pabrik as txt
			FROM
				'.$GLOBALS[my_cek].' cek
				LEFT OUTER JOIN '.$GLOBALS[my_sk].' sk ON (sk.id_cek_1 = cek.id_cek_1)
				LEFT OUTER JOIN '.$GLOBALS[my_tt].' tt ON (tt.no_tt = cek.no_tt)
				LEFT OUTER JOIN '.$GLOBALS[my_pendaftar].' pendaftar ON (pendaftar.kode_pendaftar = tt.kode_pendaftar)
				LEFT OUTER JOIN '.$GLOBALS[my_sp].' sp ON (sp.id_cek_1 = cek.id_cek_1)
			WHERE
				sk.id_cek_1 IS NULL AND sp.id_cek_1 IS NULL
			ORDER BY
				cek.date_insert';
		}else{
			$arr['sql'] = '
			SELECT
				cek.id_cek_1 as val,
    				pendaftar.nama_pabrik as txt
			FROM
				'.$GLOBALS[my_cek].' cek
				LEFT OUTER JOIN '.$GLOBALS[my_sk].' sk ON (sk.id_cek_1 = cek.id_cek_1)
				LEFT OUTER JOIN '.$GLOBALS[my_tt].' tt ON (tt.no_tt = cek.no_tt)
				LEFT OUTER JOIN '.$GLOBALS[my_pendaftar].' pendaftar ON (pendaftar.kode_pendaftar = tt.kode_pendaftar)
			WHERE
				sk.id_cek_1 IS NULL
			ORDER BY
				cek.date_insert';
		}

                $value_arr['id_cek_1'] = xform::dbs($arr);

		$optional_arr['isi_1'] = 'user_defined';
		$value_arr['isi_1'] = '<input type="text" size="80" name="isi_1" class="text" value="'.$value_arr['isi_1'].'">';
		$optional_arr['isi_2'] = 'user_defined';
		$value_arr['isi_2'] = '<input type="text" size="80" name="isi_2" class="text" value="'.$value_arr['isi_2'].'">';
		$optional_arr['isi_3'] = 'user_defined';
		$value_arr['isi_3'] = '<input type="text" size="80" name="isi_3" class="text" value="'.$value_arr['isi_3'].'">';
		$optional_arr['isi_4'] = 'user_defined';
		$value_arr['isi_4'] = '<input type="text" size="80" name="isi_4" class="text" value="'.$value_arr['isi_4'].'">';
		$optional_arr['isi_5'] = 'user_defined';
		$value_arr['isi_5'] = '<input type="text" size="80" name="isi_5" class="text" value="'.$value_arr['isi_5'].'">';

		$label_arr['submit_val'] = "Submit";
		$label_arr['form_extra']  = "<input type=hidden name=action     value='post$mode'>"; // default null
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_sp']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Surat Penolakan ".$GLOBALS[my_title]."";
		$label_arr['form_width'] = '100%';
		$label_arr['form_name'] = 'theform';

		$_form = new form();
		$_form->set_config(
			array (
				'field_arr'	=> $field_arr,
				'label_arr'	=> $label_arr,
				'value_arr'	=> $value_arr,
				'optional_arr'	=> $optional_arr
			)
		);
		return $_form->parse_field();
	}


	// create update sp form
	function update_sp_form() {
		return $this->add_sp_form();
	}


	function view_sp_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		#$field_arr = sp::get_field_set();

		/*
		 * ADDED BY : 566
		 */
		global $smarty_path, $template_path, $compile_path;
		$optional_arr = $this->optional_arr;
		$optional_arr['id_sp'] = 'protect';

		$record = array (
			'id_sp' => ${$GLOBALS['get_vars']}['id_sp']
		);
		#$result = sp::get($record);
		$value_arr = $result[0];
		$label_arr = $this->sp_label;
		global $adodb;

/*
 * Begin of Modification by : 566
 */

/*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*
 *
 * Build Date          : Fri, Jul 14, 2006
 * Script written by   : Sugeng Utomo
 *
 *`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*`*.*/

/*
 * Require Smarty Class
 */
require_once $smarty_path;

/*
 * Create an instance of Smarty Class
 */
$smarty = new Smarty;

/*
 * Define some configurations for new instance of Smarty Class
 */
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->template_dir = $template_path;
$smarty->compile_dir  = $compile_path;

/*
 * ADDED BY : 566
 */
$sql_nama_direktur_jenderal = "SELECT * FROM nama_direktur LIMIT 1";
$rs_nama_direktur_jenderal  = $adodb->Execute($sql_nama_direktur_jenderal);
$nama_direktur_jenderal     = $rs_nama_direktur_jenderal->fields['nama'];
$nip_direktur_jenderal      = $rs_nama_direktur_jenderal->fields['nip'];

/*
 * Define an SQL statement to gather data
 */
$sqlx = "SELECT
           sp.id_sp,
           sp.nomor_surat,
           sp.lampiran_surat,
           sp.date_surat,
           st.nomor_surat as nomor_surat_tambahan,
           st.lampiran_surat as lampiran_surat_tambahan,
           st.date_surat as date_surat_tambahan,
           st.alat,
           pendaftar.nama_pabrik,
           pendaftar.alamat_pabrik,
           sp.nama,
           sp.nip,
           sp.insert_by,
           sp.date_insert
         FROM ".$GLOBALS[my_table]." sp
           LEFT OUTER JOIN ".$GLOBALS[my_cek]." cek ON (cek.id_cek_1 = sp.id_cek_1)
           LEFT OUTER JOIN ".$GLOBALS[my_tt]." tt ON (tt.no_tt = cek.no_tt)
           LEFT OUTER JOIN ".$GLOBALS[my_pendaftar]." pendaftar ON (pendaftar.kode_pendaftar = tt.kode_pendaftar)
           LEFT OUTER JOIN ".$GLOBALS[my_st]." st ON(st.kepada_surat = sp.id_cek_1)
         WHERE
           sp.id_sp ='".$_GET['id_sp']."'";

/*
 * Execute an SQL statement
 */
$rsx = $adodb->Execute($sqlx);

/*
 * Fetch a recordset
 */
$nomor_surat          = $rsx->fields['nomor_surat'];
$lampiran_surat       = $rsx->fields['lampiran_surat'];
$date_surat           = $rsx->fields['date_surat'];
$nama_pabrik          = $rsx->fields['nama_pabrik'];
$alamat_pabrik        = $rsx->fields['alamat_pabrik'];
$nomor_surat_tambahan = $rsx->fields['nomor_surat_tambahan'];
$nama                 = $rsx->fields['nama'];
$nip                  = $rsx->fields['nip'];
$alat                 = ($rsx->fields['alat']=='') ? '...................' : $rsx->fields['alat'];
$date_surat_tambahan  = ($rsx->fields['date_surat_tambahan'] == '') ? '' : date('d M Y',$rsx->fields['date_surat_tambahan']);

/*
 * Start Output Buffer
 */
ob_start();

/*
 * Assign some Smarty variables
 */
$smarty->assign('nomor_surat',$nomor_surat);
$smarty->assign('date_surat',date('d M Y',$date_surat));
$smarty->assign('lampiran_surat',$lampiran_surat);
$smarty->assign('nama_pabrik',$nama_pabrik);
$smarty->assign('alamat_pabrik',$alamat_pabrik);
$smarty->assign('tanggal_alkes',"NOT DEFINED");
$smarty->assign('produk',"NOT DEFINED");
$smarty->assign('nama',$nama);
$smarty->assign('nip',$nip);
$smarty->assign('nama_direktur_jenderal',$nama_direktur_jenderal);
$smarty->assign('nip_direktur_jenderal',$nip_direktur_jenderal);

/*
 * Display template results
 */
$smarty->display('surat_penolakan.tpl');

/*
 * Define a temp folder
 */
$tmpfname = tempnam("/tmp", "FOO");

/*
 * Open a temp file with writeable mode
 */
$handle = fopen($tmpfname, "w");

/*
 * Write a temp file with Output Buffer Content
 */
fwrite($handle, ob_get_contents());

/*
 * End Output Buffer
 */
ob_end_clean();

/*
 * Close a temp file
 */
fclose($handle);
putenv("HTMLDOC_NOCGI=1");
/*
 * Define a header with Content-Type: application/pdf
 */
header('Content-Type: application/pdf');
flush();
/*
 * Execute an external program and then display raw output
 */
passthru('htmldoc -t pdf --webpage '.$tmpfname);

/*
 * Delete a temp file
 */
unlink($tmpfname);

/*
 * End of Modification by : 566
 */

	}

	// handle event add sp
	function add_sp() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;

		$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_table]." WHERE id_sp = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$record['date_surat'] = $this->parsedate(trim($_POST['date_surat']));
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$record['date_surat'] = $this->parsedate(trim($_POST['date_surat']));
			$record['insert_by'] = $ses->loginid;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM ".$GLOBALS[my_table]." WHERE id_sp = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st SP ".$GLOBALS[my_title]." '<b>{$record['id_sp']}</b>'";
		$this->log($status);
		$_block = new block();
		$_block->set_config('title', 'Status Surat Penolakan '.$GLOBALS[my_title].'');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}


	// handle event update sp
	function update_sp() {
		return $this->add_sp();
	}

	// handle delete sp
	function delete_sp() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['get_vars']}, ${$GLOBALS['post_vars']};

		global $adodb;
		$query = "";
		$query3 = "";
		for ($i=0;$i<count(${$GLOBALS['post_vars']}['pk_str']);$i++) {
			if ($query) $query .= " OR ";
			if ($query3) $query3 .= " OR ";

			$var_pie = explode("&", ${$GLOBALS['post_vars']}['pk_str'][$i]);
			$query2 = "";
			$query4 = "";
			foreach ($var_pie as $key => $value) {
				list($myvar, $myval) = explode("=", $value);
				if ($query2) $query2 .= " AND ";
				$query2 .= "$myvar='".urldecode($myval)."'";
				if ($myvar=='fill_this') {
					if ($query4) $query4 .= " AND ";
					$query4 .= "$myvar='".urldecode($myval)."'";
				}
			}
			if ($query2) $query .= "($query2)";
			if ($query4) $query3 .= "($query4)";
		}

		global $self_close_js;
		if ($query)
                        $success = $adodb->Execute("delete from ".$GLOBALS[my_table]." where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'SP '.$GLOBALS[my_title].' <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'SP '.$GLOBALS[my_title].' <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Surat Penolakan '.$GLOBALS[my_title].''));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list sp
	function list_sp($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};

		/*
		 * ADDED BY : 566
		 */
		$sql_nama_direktur_jenderal = "SELECT * FROM nama_direktur LIMIT 1";
		$rs_nama_direktur_jenderal  = $adodb->Execute($sql_nama_direktur_jenderal);
		$nama_direktur_jenderal     = $rs_nama_direktur_jenderal->fields['nama'];

		$sql = '
		SELECT
		sp.id_sp,
		sp.nomor_surat,
		sp.lampiran_surat,
		sp.date_surat,
		cek.no_pemohon,
		cek.date_pemohon,
		pendaftar.nama_pabrik,
		pendaftar.alamat_pabrik,'.

/*
 * Modified By : 566
 *
 * BEFORE : 
 * sp.nama
 *
 * AFTER :
 */
		"'$nama_direktur_jenderal' AS nama,".
		'sp.nip,
		sp.insert_by,
		sp.date_insert
		FROM '.$GLOBALS[my_table].' sp
		LEFT OUTER JOIN '.$GLOBALS[my_cek].' cek ON (cek.id_cek_1 = sp.id_cek_1)
		LEFT OUTER JOIN '.$GLOBALS[my_tt].' tt ON (tt.no_tt = cek.no_tt)
		LEFT OUTER JOIN '.$GLOBALS[my_pendaftar].' pendaftar ON(pendaftar.kode_pendaftar = tt.kode_pendaftar)
		ORDER BY sp.nomor_surat DESC
		';

		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_sp' => FALSE,
			'passwd' => TRUE,
			'name' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'id_sp' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 600, 400, null, null, \'add_sp\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_sp\');'.
			'win.focus()', 
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));
//
		$view_anchor = pager::pager_button(array("link"=>'javascript:'.
			'location.href=\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\';'.
			'',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' . 
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_sp\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_sp\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->sp_label;
		$config = array (
			'id'		=> 'sp',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $add_anchor,
			'edit_anchor'	=> "<nobr>".$edit_anchor." ".$view_anchor,
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Surat Penolakan '.$GLOBALS[my_title].' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print sp
	function print_sp() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_sp($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$sp_controller = new sp_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $sp_controller->add_sp_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $sp_controller->add_sp();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $sp_controller->update_sp_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $sp_controller->update_sp();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $sp_controller->view_sp_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $sp_controller->delete_sp();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $sp_controller->import_sp_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $sp_controller->import_sp();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $sp_controller->print_sp();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $sp_controller->list_sp();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Surat Penolakan '.$GLOBALS[my_title].' Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>
