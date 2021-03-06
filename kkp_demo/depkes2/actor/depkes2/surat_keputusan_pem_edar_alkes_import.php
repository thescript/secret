<?php

	require 'init.php';
	require 'auth.php';

if (class_exists('surat_keputusan_pem_edar_alkes_import_controller')) {
	// do nothing
} else if (defined('CLASS_surat_keputusan_pem_edar_alkes_import_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_surat_keputusan_pem_edar_alkes_import_CONTROLLER', TRUE);

include_once 'class.surat_keputusan_pem_edar_alkes_import.inc.php';
class surat_keputusan_pem_edar_alkes_import_controller extends depkes2_manager {
	var $surat_keputusan_pem_edar_alkes_import_label;
	var $optional_arr;
	function surat_keputusan_pem_edar_alkes_import_controller() {
		$this->surat_keputusan_pem_edar_alkes_import_label = array (
			'id_surat_keputusan_pem_edar_alkes_import' => 'Id Surat keputusan Pemutihan Edar Alkes Import',
			'no_surat_keputusan_pem_edar_alkes_import' => 'Nomor Surat Keputusan Pemutihan Edar Alkes Import',
			'id_cek_1' => 'Nama Pabrik',
			'nama' => 'Pengesah',
			'nip' => 'NIP pengesah',
			'nama_pabrik' => 'Nama Pabrik',
			'insert_by' => 'Insert By',
			'date_insert' => 'Date Insert'
		);
		$this->depkes2_manager();
		$this->optional_arr = array (
			'id_surat_keputusan_pem_edar_alkes_import' => TRUE,
			'surat_keputusan_pem_edar_alkes_import' => FALSE,
			'keputusan_pem_edar_alkes_import' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}

	
 function id_cek_1_form(&$config) {
                eval($this->load_config);
                $selected = $value_arr['id_cek_1'];

		include_once 'class.cek_kelengkapan_data_pem_alkes_import.inc.php';
		if($_GET['action']=='edit'){
		$fk_sql = ''.
			'SELECT
				cek_kelengkapan_data_pem_alkes_import.id_cek_1 as skey,
				tt_1_pem_edar_alkes_import.urut_no_tt as svalue,
				pendaftar_pem_edar_alkes_import.nama_pabrik as svalue2
			FROM
				cek_kelengkapan_data_pem_alkes_import
			LEFT OUTER JOIN tt_1_pem_edar_alkes_import ON(tt_1_pem_edar_alkes_import.no_tt = cek_kelengkapan_data_pem_alkes_import.no_tt)
			LEFT OUTER JOIN pendaftar_pem_edar_alkes_import ON(pendaftar_pem_edar_alkes_import.kode_pendaftar_pem_edar_alkes_import = tt_1_pem_edar_alkes_import.kode_pendaftar_pem_edar_alkes_import)
			LEFT OUTER JOIN surat_penolakan_pem_edar_alkes_import ON( surat_penolakan_pem_edar_alkes_import.id_cek_1 = cek_kelengkapan_data_pem_alkes_import.id_cek_1)
			WHERE
			surat_penolakan_pem_edar_alkes_import.id_cek_1 IS NULL AND
   			(cek_kelengkapan_data_pem_alkes_import.status_direktur = \'0\' OR cek_kelengkapan_data_pem_alkes_import.status_kasubdit = \'0\')
			ORDER BY
				cek_kelengkapan_data_pem_alkes_import.date_insert
			';
		}else{
			$fk_sql = ''.
			'SELECT
				cek_kelengkapan_data_pem_alkes_import.id_cek_1 as skey,
				tt_1_pem_edar_alkes_import.urut_no_tt as svalue,
				pendaftar_pem_edar_alkes_import.nama_pabrik as svalue2
			FROM
				cek_kelengkapan_data_pem_alkes_import
			LEFT OUTER JOIN surat_keputusan_pem_edar_alkes_import ON(surat_keputusan_pem_edar_alkes_import.id_cek_1 = cek_kelengkapan_data_pem_alkes_import.id_cek_1)
			LEFT OUTER JOIN tt_1_pem_edar_alkes_import ON(tt_1_pem_edar_alkes_import.no_tt = cek_kelengkapan_data_pem_alkes_import.no_tt)
			LEFT OUTER JOIN pendaftar_pem_edar_alkes_import ON(pendaftar_pem_edar_alkes_import.kode_pendaftar_pem_edar_alkes_import = tt_1_pem_edar_alkes_import.kode_pendaftar_pem_edar_alkes_import)
			LEFT OUTER JOIN surat_penolakan_pem_edar_alkes_import ON( surat_penolakan_pem_edar_alkes_import.id_cek_1 = cek_kelengkapan_data_pem_alkes_import.id_cek_1)
			WHERE
			(surat_keputusan_pem_edar_alkes_import.id_cek_1 IS NULL AND surat_penolakan_pem_edar_alkes_import.id_cek_1 IS NULL) AND
			(cek_kelengkapan_data_pem_alkes_import.status_direktur = \'0\' OR	cek_kelengkapan_data_pem_alkes_import.status_kasubdit = \'0\')
			ORDER BY
				cek_kelengkapan_data_pem_alkes_import.date_insert
			';
		}
		//print $fk_sql;
		$result = cek_kelengkapan_data_pem_alkes_import::select($fk_sql);
		$opener_sql = htmlentities($fk_sql);
		$opener_sql = str_replace("\n", " ", $opener_sql);
		$opener_var = htmlentities('id_cek_1');
		$default_value = array(
			array (
				'skey' => '',
				'svalue' => __('No Tanda Terima - ').' '.$this->surat_keputusan_pem_edar_alkes_import_label['id_cek_1']
			)
		);
		$result = array_merge($default_value, $result);
		$optional_arr['id_cek_1'] = 'user_defined';
		$value_arr['id_cek_1'] = $this->select_form('id_cek_1', $result, $selected);
		$optional_arr['id_cek_1_rule'] = "\n".
		"       if(theform.id_cek_1.value == '')\n".
		"       {\n".
		"               alert('Field ".$label_arr['id_cek_1']." ".__('empty').".');\n".
		"               theform.id_cek_1.focus();\n".
		"               form_submitted=false;\n".
		"               return false;\n".
		"       }\n";


	}


	// create add surat_keputusan_pem_edar_alkes_import form
	function add_surat_keputusan_pem_edar_alkes_import_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		$field_arr = surat_keputusan_pem_edar_alkes_import::get_field_set();

//		$value_arr = array ();
		$label_arr = $this->surat_keputusan_pem_edar_alkes_import_label;
		$optional_arr = $this->optional_arr;
		$optional_arr['keputusan_pem_edar_alkes_import'] = 'user_defined';
		$value_arr['keputusan_pem_edar_alkes_import']= '<textarea rows="100" cols="75" name="keputusan_pem_edar_alkes_import" class="text"></textarea>';

		eval($this->save_config);
		$this->id_cek_1_form($config);

//		$label_arr['submit_val'] = 'Submit';
		$label_arr['form_extra'] = '<input type=hidden name=action value="postadd">'; // default null
		$label_arr['form_extra'] .= '<input type=hidden name=opener value="'.$GLOBALS[$GLOBALS['get_vars']]['opener'].'">'; // default null
		$label_arr['form_extra'] .= '<input type=hidden name=opener_sql value="'.$GLOBALS[$GLOBALS['get_vars']]['opener_sql'].'">'; // default null
		$label_id_cek_1arr['form_extra'] .= '<input type=hidden name=opener_var value="'.$GLOBALS[$GLOBALS['get_vars']]['opener_var'].'">'; // default null
		$label_arr['form_title'] = __('Form').' '.__('Add').' Surat keputusan Izin Pemutihan Edar Alkes Import'; // default null
		$label_arr['form_width'] = '100%'; // default 100%
		$label_arr['form_name'] = 'theform'; // default form

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

	// create update surat_keputusan_pem_edar_alkes_import form
	function update_surat_keputusan_pem_edar_alkes_import_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		$field_arr = surat_keputusan_pem_edar_alkes_import::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_surat_keputusan_pem_edar_alkes_import'] = 'protect';
		$record = array (
			'id_surat_keputusan_pem_edar_alkes_import' => ${$GLOBALS['get_vars']}['id_surat_keputusan_pem_edar_alkes_import']
		);
		$result = surat_keputusan_pem_edar_alkes_import::get($record);
		$value_arr = $result[0];
		$label_arr = $this->surat_keputusan_pem_edar_alkes_import_label;

		eval($this->save_config);
		$this->id_cek_1_form($config);
		$optional_arr['keputusan_pem_edar_alkes_import'] = 'user_defined';
		$value_arr['keputusan_pem_edar_alkes_import']= '<textarea rows="100" cols="75" name="keputusan_pem_edar_alkes_import" class="text">'.$value_arr['keputusan_pem_edar_alkes_import'].'</textarea>';
//		$label_arr['submit_val'] = 'Submit';
		$label_arr['form_extra'] = '<input type=hidden name=action value=postedit>'; // default null
		$label_arr['form_title'] = ('Update Surat keputusan Izin Pemutihan Edar Alkes Import Form'); // default null
		$label_arr['form_width'] = '100%'; // default 100%
		$label_arr['form_name'] = 'theform'; // default form

		$_form = new form();    

		$_form->set_config(
			array (
				'field_arr'		=> $field_arr,
				'optional_arr'	=> $optional_arr,
				'value_arr'		=> $value_arr,
				'label_arr'		=> $label_arr
			)
		);
		return $_form->parse_field();
	}

	// create import surat_keputusan_pem_edar_alkes_import form
	function import_surat_keputusan_pem_edar_alkes_import_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']};
		$field_arr[] = array ('name' => 'userfile');
		$optional_arr['userfile'] = 'user_defined';
		$value_arr['userfile'] = '<input class=text type=file name=userfile>';

		eval($this->save_config);
		$label_arr['userfile'] = 'Import File';
		$label_arr['submit_val'] = 'Import'; // default Submit
		$label_arr['form_extra'] = '<input type=hidden name=action value=postimport>'; // default null
		$label_arr['form_title'] = ('Import Surat keputusan Izin Pemutihan Edar Alkes Import Form'); // default null
		$label_arr['form_width'] = '100%'; // default 100%
		$label_arr['form_name'] = 'theform'; // default form

		$_form = new form();
		$_form->set_config(
			array (
				'field_arr'		=> $field_arr,
				'label_arr'		=> $label_arr,
				'value_arr'		=> $value_arr,
				'optional_arr'	=> $optional_arr
			)
		);
		return $_form->parse_field();
	}

	// handle event add surat_keputusan_pem_edar_alkes_import
	function add_surat_keputusan_pem_edar_alkes_import() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['post_vars']};
		$record = array (
			'no_surat_keputusan_pem_edar_alkes_import' => ${$GLOBALS['post_vars']}['no_surat_keputusan_pem_edar_alkes_import'],
			'id_cek_1' => ${$GLOBALS['post_vars']}['id_cek_1'],
			'nama' => ${$GLOBALS['post_vars']}['nama'],
			'nip' => ${$GLOBALS['post_vars']}['nip'],
			'insert_by' => $GLOBALS['ses']->loginid,
			'date_insert' => time()
		);
		$_block = new block();
		$_block->set_config('title', __('Status').' '.__('Add').' Surat keputusan Izin Pemutihan Edar Alkes Import');
		$_block->set_config('width', 595);
		if (! surat_keputusan_pem_edar_alkes_import::get($record)) {
			eval($this->save_config);
			if (surat_keputusan_pem_edar_alkes_import::add($record)) {


				if ($GLOBALS[$GLOBALS['post_vars']]['opener']) {
					$opener_sql = $GLOBALS[$GLOBALS['post_vars']]['opener_sql'];
					$opener_var = $GLOBALS[$GLOBALS['post_vars']]['opener_var'];
					if (! $record[$opener_var]) {
						if (eregi('postgre', $GLOBALS['adodb_type']))
							$last_id = $GLOBALS['adodb']->Execute(
							"SELECT
								currval('surat_keputusan_pem_edar_alkes_import_{$opener_var}_seq') AS last_id
							FROM
								surat_keputusan_pem_edar_alkes_import"
							);
						else if (eregi('mysql', $GLOBALS['adodb_type']))
							$last_id = $GLOBALS['adodb']->Execute(
							'SELECT last_insert_id() AS last_id'
							);
						$record[$opener_var] = $last_id->fields['last_id'];
					}
					$result = $GLOBALS['adodb']->Execute($opener_sql);
					$refresh_add_js = '';
					while (! $result->EOF) {
						$result_text = '';
						if (isset($result->fields['svalue'])) $result_text .= $result->fields['svalue'];
						if (isset($result->fields['svalue2'])) $result_text .= ' - '.$result->fields['svalue2'];
						if (isset($result->fields['svalue3'])) $result_text .= ' - '.$result->fields['svalue3'];
						if (isset($result->fields['svalue4'])) $result_text .= ' - '.$result->fields['svalue4'];
						if (isset($result->fields['svalue5'])) $result_text .= ' - '.$result->fields['svalue5'];
						$refresh_add_js .= "index=window.top.opener.{$opener_var}_add(".
							"'{$result_text}', ".
							"'{$result->fields['skey']}');\n";
						if ($result->fields['skey'] == $record[$opener_var])
							$refresh_add_js .= 'window.top.opener.document.theform.'.
								$opener_var.'.options[index].selected = true;';
						$result->MoveNext();
					}
					$refresh_js = <<< EOT
<script language=javascript>
	var q=window.top.opener.document.theform.{$opener_var}.options.length-1;
	for (;q>=1;q--)
		window.top.opener.document.theform.{$opener_var}.options[q] = null;
{$refresh_add_js}
</script>
EOT;
					$GLOBALS['self_close_js'] = <<< EOT
<script language=javascript>
self.setTimeout('window.top.opener.focus();window.top.close();', 500);
</script>
EOT;
				}

				$_block->parse(array('+<font color=green><b>'.__('Successfull Added').'</b></font>'));
				return $_block->get_str().$refresh_js;
			}
		}
		$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
		$_block->parse(array('+<font color=red><b>'.__('Failed Added').'</b></font>'.' :'.__('Data already exists')));
		return  $_block->get_str();
	}

	// handle event update surat_keputusan_pem_edar_alkes_import
	function update_surat_keputusan_pem_edar_alkes_import() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['post_vars']};
		$record = array (
			'id_surat_keputusan_pem_edar_alkes_import' => ${$GLOBALS['post_vars']}['id_surat_keputusan_pem_edar_alkes_import']
		);
		$_block = new block();
		$_block->set_config('title', ('Update Surat keputusan Izin Pemutihan Edar Alkes Import Status'));
		$_block->set_config('width', 595);
		if ($result = surat_keputusan_pem_edar_alkes_import::get($record)) {
			$record = $result[0];
			if (${$GLOBALS['post_vars']}['surat_keputusan_pem_edar_alkes_import']!='') $record['surat_keputusan_pem_edar_alkes_import'] = ${$GLOBALS['post_vars']}['surat_keputusan_pem_edar_alkes_import'];
			if (${$GLOBALS['post_vars']}['keputusan_pem_edar_alkes_import']!='') $record['keputusan_pem_edar_alkes_import'] = ${$GLOBALS['post_vars']}['keputusan_pem_edar_alkes_import'];
			if (${$GLOBALS['post_vars']}['nama']!='') $record['nama'] = ${$GLOBALS['post_vars']}['nama'];
			if (${$GLOBALS['post_vars']}['nip']!='') $record['nip'] = ${$GLOBALS['post_vars']}['nip'];
			if (${$GLOBALS['post_vars']}['insert_by']!='') $record['insert_by'] = ${$GLOBALS['post_vars']}['insert_by'];
			if (${$GLOBALS['post_vars']}['date_insert']!='') $record['date_insert'] = $this->parsedate(trim(${$GLOBALS['post_vars']}['date_insert']));

			eval($this->save_config);
			if (surat_keputusan_pem_edar_alkes_import::update($record)) {

				$_block->parse(array('+<font color=green><b>'.__('Successfull Updated').'</b></font>'));
				return $_block->get_str();
			}
		}
		$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
		$_block->parse(array('+<font color=red><b>'.__('Failed Updated').'</b></font>'.' :'.__('Data doesn\'t exists')));
		return  $_block->get_str();
	}

	// handle delete surat_keputusan_pem_edar_alkes_import
	function delete_surat_keputusan_pem_edar_alkes_import() {
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
					$query4 .= "$myvar='$myval'";
				}
			}
			if ($query2) $query .= "($query2)";
			if ($query4) $query3 .= "($query4)";
		}


		if ($query)
			$success = $adodb->Execute("delete from surat_keputusan_pem_edar_alkes_import where ".$query);

		$_block = new block();
		$_block->set_config('title', ('Delete Surat keputusan Izin Pemutihan Edar Alkes Import Status'));
		$_block->set_config('width', 595);
				$info[] = ('+surat_keputusan_pem_edar_alkes_import <font color=red>'.$query.'</font> <font color=green><b>'.__('Successfull Deleted').'</b></font>');
//				$adodb->Execute('delete from fill_this where '.$query3);
		if ($success){
			$_block->parse(&$info);
			return $_block->get_str();
		} else {
			$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
			$_block->parse(array('+<font color=red><b>'.__('Failed Deleted').'</b></font>'));
			return $_block->get_str();
		}
	}



	function view_surat_keputusan_pem_edar_alkes_import_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		$field_arr = surat_keputusan_pem_edar_alkes_import::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_surat_keputusan_pem_edar_alkes_import'] = 'protect';

		$record = array (
			'id_surat_keputusan_pem_edar_alkes_import' => ${$GLOBALS['get_vars']}['id_surat_keputusan_pem_edar_alkes_import']
		);
		$result = surat_keputusan_pem_edar_alkes_import::get($record);
		$value_arr = $result[0];
		$label_arr = $this->surat_keputusan_pem_edar_alkes_import_label;

		$sqlA = "SELECT
		no_surat_keputusan_pem_edar_alkes_import,
		id_cek_1
		FROM
		surat_keputusan_pem_edar_alkes_import
		WHERE
		id_surat_keputusan_pem_edar_alkes_import ='".$value_arr['id_surat_keputusan_pem_edar_alkes_import']."'
		";

		$hasil=$adodb->Execute($sqlA);
		WHILE(! $hasil->EOF){
			$no_surat_keputusan_pem_edar_alkes_import = $hasil->fields['no_surat_keputusan_pem_edar_alkes_import'];
			$id_cek_1 = $hasil->fields['id_cek_1'];
		$hasil->MoveNext();
		}
		
		$sqlB="
		select
		surat_keputusan_pem_edar_alkes_import.id_surat_keputusan_pem_edar_alkes_import,
		surat_keputusan_pem_edar_alkes_import.no_surat_keputusan_pem_edar_alkes_import,
		surat_keputusan_pem_edar_alkes_import.nama,
		surat_keputusan_pem_edar_alkes_import.nip,
		pendaftar_pem_edar_alkes_import.nama_pendaftar_pem_edar_alkes_import,
		pendaftar_pem_edar_alkes_import.nama_pabrik,
		pendaftar_pem_edar_alkes_import.npwp,
		pendaftar_pem_edar_alkes_import.alamat_pendaftar_pem_edar_alkes_import,
		pendaftar_pem_edar_alkes_import.namapenanggungjwb,
		pendaftar_pem_edar_alkes_import.alamatgudang,
		pendaftar_pem_edar_alkes_import.alamat_bengkel,
		pendaftar_pem_edar_alkes_import.alamat_pabrik,
		pendaftar_pem_edar_alkes_import.nama_propinsi_1,
		pendaftar_pem_edar_alkes_import.nama_propinsi_2,
		pendaftar_pem_edar_alkes_import.nama_direktur,
		gol_alkes.golongan,
		tt_1_pem_edar_alkes_import.urut_no_tt,
		tt_1_pem_edar_alkes_import.kode_subdit,
		tt_1_pem_edar_alkes_import.date_insert,
		cek_kelengkapan_data_pem_alkes_import.jenis,
		cek_kelengkapan_data_pem_alkes_import.kemasan,
		cek_kelengkapan_data_pem_alkes_import.ukuran,
		kategori_pem_edar.nama_kategori_pem_edar,
		sub_kategori_pem_edar.nama_sub_kategori_pem_edar,
		cek_kelengkapan_data_pem_alkes_import.nama_produk,
		cek_kelengkapan_data_pem_alkes_import.no_pemohon
		from
		surat_keputusan_pem_edar_alkes_import
		LEFT OUTER JOIN cek_kelengkapan_data_pem_alkes_import ON(cek_kelengkapan_data_pem_alkes_import.id_cek_1 = surat_keputusan_pem_edar_alkes_import.id_cek_1)
		LEFT OUTER JOIN tt_1_pem_edar_alkes_import ON(tt_1_pem_edar_alkes_import.no_tt = cek_kelengkapan_data_pem_alkes_import.no_tt)
		LEFT OUTER JOIN pendaftar_pem_edar_alkes_import ON(pendaftar_pem_edar_alkes_import.kode_pendaftar_pem_edar_alkes_import = tt_1_pem_edar_alkes_import.kode_pendaftar_pem_edar_alkes_import)
		LEFT OUTER JOIN gol_alkes ON(gol_alkes.id_golongan = cek_kelengkapan_data_pem_alkes_import.id_golongan)
		LEFT OUTER JOIN kategori_pem_edar ON(kategori_pem_edar.id_kategori_pem_edar = cek_kelengkapan_data_pem_alkes_import.id_kategori_pem_edar)
		LEFT OUTER JOIN sub_kategori_pem_edar ON(sub_kategori_pem_edar.id_sub_kategori_pem_edar = cek_kelengkapan_data_pem_alkes_import.id_sub_kategori_pem_edar)
		WHERE
		surat_keputusan_pem_edar_alkes_import.id_cek_1 = '".$id_cek_1."'
		";
		//print $sqlB;
		$rsb = $adodb->Execute($sqlB);
		$golongan = $rsb->fields['golongan'];
		$nama_produk = $rsb->fields['nama_produk'];
		$no_surat_keputusan_pem_edar_alkes_import = $rsb->fields['no_surat_keputusan_pem_edar_alkes_import'];
		$nama_perusahaan = $rsb->fields['nama_pabrik'];
		$nama_propinsi_1 = $rsb->fields['nama_propinsi_1'];
		$alamat_pendaftar = $rsb->fields['alamat_pendaftar'];
		$urut_no_tt = $rsb->fields['urut_no_tt'];
		$nama_penanggung = $rsb->fields['namapenanggungjwb'];
		$alamat_gudang = $rsb->fields['alamatgudang'];
		$alamat_bengkel = $rsb->fields['alamat_bengkel'];
		$nama_direktur = $rsb->fields['nama_direktur'];
		$date_insert = date('d M Y',$rsb->fields['date_insert']);
		$no_rekomendasi = $rsb->fields['no_rekomendasi'];
		$no_pemohon = $rsb->fields['no_pemohon'];
		$date_pemohon = date('d M Y',$rsb->fields['date_pemohon']);
		$alamat_pabrik = $rsb->fields['alamat_pabrik'];
		$nama_propinsi_2 = $rsb->fields['nama_propinsi_2'];
		$date_rekomendasi = date('d M Y',$rsb->fields['date_rekomendasi']);
		$no_bap = $rsb->fields['no_bap'];
		$npwp = $rsb->fields['npwp'];
		$date_bap = date('d M Y',$rsb->fields['date_bap']);
		$kode_subdit = $rsb->fields['kode_subdit'];
		$nama = $rsb->fields['nama'];
		$nip = $rsb->fields['nip'];
		$kategori = $rsb->fields['nama_kategori_pem_edar'];
		$sub_kategori = $rsb->fields['nama_sub_kategori_pem_edar'];
		$nama = $rsb->fields['nama'];
		$jenis = $rsb->fields['jenis'];
		$kemasan = $rsb->fields['kemasan'];
		$nama_pendaftar_pem_edar_alkes_import = $rsb->fields['nama_pendaftar_pem_edar_alkes_import'];
		$ukuran = $rsb->fields['ukuran'];

		$rsS = $adodb->Execute("SELECT keterangan FROM subdit where id_subdit = '".$kode_subdit."'");
		$ketS = $rsS->fields[keterangan];
		

		


		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','legal');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(180,7,'Berdasarkan : ','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'1. Peraturan Menterii Kesehatan R.I No.140/Menkes/Per/III/1991 Tanggal 4 Maret 1991 tentang','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Wajib Daftar Alat Kesehatan, Kosmetik dan Perbekalan Kesehatan Rumah Tangga','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'2. Keputusan Direktur Jenderal Pengawasan Obat dan Makanan No.177/C/SK/IV/1991 tentang','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Petunjuk Pelaksanaan Wajib Daftar Alat Kesehatan, Kosmetik dan Perbekalan Kesehatan','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(160,7,'    Rumah Tangga','',0,'L');
		$pdf->Ln(5);

		$pdf->Cell(180,7,'dengan ini diberikan perstujuan untuk dipem_edarkan dengan : ','',0,'L');
		$pdf->Ln(20);
		$pdf->Cell(180,7,'NOMOR PENDAFTARAN','',0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Ln(10);
		$pdf->Cell(180,7,'A L A T  K E S E H A T A N','',0,'C');
		$pdf->Ln(10);
		$pdf->Cell(180,7,''.$no_surat_keputusan_pem_edar_alkes_import.'','',0,'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',12);
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Nama Produk','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$nama_produk.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Jenis produk','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$jenis.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Kategori','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$kategori.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Sub Kategori','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$sub_kategori.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Tipe / Ukuran','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$ukuran.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Kemasan','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$kemasan.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Nama Pabrik','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$nama_perusahaan.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Nama Pendaftar','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$nama_pendaftar_pem_edar_alkes_import.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Atas Dasar Lisensi Dari','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,''.$no_pemohon.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Ketentuan','',0,'L');$pdf->Cell(5,7,'  ','',0,'L');$pdf->Cell(110,7,'Wajib menyampaikan laporan berkala setiap 1 (satu) tahun terhadap ','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'','',0,'L');$pdf->Cell(5,7,'  ','',0,'L');$pdf->Cell(110,7,'jenis dan akibat samping dari produk yang dipem_edarkan','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'Persyaratan','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,'1. Apabila dikemudian hari ada pihak lain yang lebih berhak atas nama','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'','',0,'L');$pdf->Cell(5,7,'  ','',0,'L');$pdf->Cell(110,7,'    produk diatas sesuai dengan ketentuan yang berlaku,maka pendaftar','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'','',0,'L');$pdf->Cell(5,7,'  ','',0,'L');$pdf->Cell(110,7,'     bersedia mengganti nama produk Alat Kesehatan tersebut.','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'','',0,'L');$pdf->Cell(5,7,' : ','',0,'L');$pdf->Cell(110,7,'2. Apabila dikemudian hari terdapat kekeliruan  maka   persetujuan   ini ','',0,'L');
		$pdf->Ln();
		$pdf->Cell(20,7,'','',0,'L');$pdf->Cell(45,7,'','',0,'L');$pdf->Cell(5,7,'  ','',0,'L');$pdf->Cell(110,7,'    akan ditinjau kembali.','',0,'L');
		$pdf->Ln(15);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(30,7,'Ditetapkan di','',0,'L');$pdf->Cell(60,7,' : J a k a r t a ','',0,'L');
		$pdf->Ln();
		$tg = date('d M Y');
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(30,7,'Pada tanggal','B',0,'L');$pdf->Cell(40,7,' : '.$tg.'','B',0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);

		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'a.n MENTERI KESEHATAN REPUBLIK INDONESIA','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'DIREKTUR JENDERAL PELAYANAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'KEFARMASIAN DAN ALAT  KESEHATAN','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'u.b. DIREKTUR BINA PRODUKSI DAN DISTRIBUSI','',0,'C');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(100,7,'ALAT KESEHATAN','',0,'C');
		$pdf->Ln(30);
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,''.$nama.'','B',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(80,7,'','',0,'L');$pdf->Cell(10,7,'','',0,'L');$pdf->Cell(80,7,'NIP .'.$nip.'','',0,'C');$pdf->Cell(10,7,'','',0,'L');
		$pdf->Ln();


		$pdf->Output();


		$_form = $lamp;

		return $_form;
	}






	// handle event import surat_keputusan_pem_edar_alkes_import
	function import_surat_keputusan_pem_edar_alkes_import() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['post_vars']}, ${$GLOBALS['files_vars']};
		$pk = array (
			'id_surat_keputusan_pem_edar_alkes_import' => TRUE
		);
		$label_arr = $this->surat_keputusan_pem_edar_alkes_import_label;

		$fd = fopen(${$GLOBALS['files_vars']}['userfile']['tmp_name'], "r");
		while (! feof($fd)) {
			$buffer = fgets($fd, 4096);
			$piece = split(",", $buffer);
			if (empty($field_arr)) {
				$insert_key = "";
				for ($i=0;$i<count($piece);$i++) {
					$buffer2 = trim(preg_replace("/^\"(.*)\"$/", "\\1", $piece[$i]), "\xA0 \t\n\r\0\x0B");
					$field_arr[$i] = array_search($buffer2, $label_arr);
					if ($field_arr[$i]) {
						if ($insert_key) $insert_key .= ',';
						$insert_key .= $field_arr[$i];
					}
					$count_piece++;
				}
				if ($insert_key) $insert_key = "(".$insert_key.")";
			} else if (count($piece) == $count_piece) {
				for ($i=0;$i<count($piece);$i++) {
					$buffer2 = trim(preg_replace("/^\"(.*)\"$/", "\\1", $piece[$i]), "\xA0 \t\n\r\0\x0B");
					if ($field_arr[$i]) {
						if ($insert_extra) $insert_extra .= ',';
						$insert_extra .= '\''.$buffer2.'\'';
						if ($pk[$field_arr[$i]]) {
							if ($delete_extra) $delete_extra .= " AND ";
							$delete_extra .= $field_arr[$i].'=\''.$buffer2.'\'';
						}
					}
				}
				if ($insert_extra) {
					$insert_extra = "(".$insert_extra.")";
					if ($insert_value) $insert_value .= ",";
					$insert_value .= $insert_extra;
					unset($insert_extra);
				}
				if ($delete_extra) {
					$delete_extra = "(".$delete_extra.")";
					if ($delete_where) $delete_where .= " OR ";
					$delete_where .= $delete_extra;
					unset($delete_extra);
				}
			}
		}
		fclose($fd);
		unlink(${$GLOBALS['files_vars']}['userfile']['tmp_name']);

		global $adodb;
		if ($delete_where) $delete_query = "DELETE FROM surat_keputusan_pem_edar_alkes_import WHERE ".$delete_where." ;";
		$adodb->Execute($delete_query);

		if ($insert_key && $insert_value) {

			srand((double)microtime()*1000000);
			$output_file = '/tmp/'.md5(rand()).'.output.txt';
			$all_query = $insert_value;

			$all_query = str_replace("),", ")\n", $all_query);
			if (strstr($GLOBALS['adodb_type'], 'mysql')) {
				$piece = explode("\n", $all_query);
				foreach ($piece as $key => $value) {
					$value = str_replace('(\'', '', $value);
					$value = str_replace('\',\'', "\t", $value);
					$value = str_replace('\')', '', $value);
					if ($data_file) $data_file .= "\n";
					$data_file .= $value;
				}
				$fl = fopen($output_file.'.mysql', 'w');
				fwrite($fl, $data_file);
				fclose($fl);
				$adodb->Execute('LOAD DATA INFILE \''.$output_file.'.mysql'.'\' INTO TABLE surat_keputusan_pem_edar_alkes_import '.$insert_key);
				unlink($output_file.'.mysql');
			} else if (strstr($GLOBALS['adodb_type'], 'postgres')) {

			        $piece = explode("\n", $all_query);
				foreach ($piece as $key => $value) {
					$value = str_replace('(\'', '', $value);
					$value = str_replace('\',\'', "\t", $value);
					$value = str_replace('\')', '', $value);
					if ($data_file) $data_file .= "\n";
					$data_file .= $value;
				}
				$fl = fopen($output_file.'.pgsql', 'w');
				fwrite($fl, $data_file);
				fclose($fl);
				$adodb->Execute('COPY surat_keputusan_pem_edar_alkes_import '.$insert_key.' FROM \''.$output_file.'.pgsql'.'\'');
				unlink($output_file.'.pgsql');
			} else {
				$piece = explode("\n", $all_query);
				foreach ($piece as $key => $value) {
					$adodb->Execute('INSERT INTO surat_keputusan_pem_edar_alkes_import '.$insert_key.' VALUES '.$value);
				}
			}
		}

		$_block = new block();
		$_block->set_config('title', ('Import surat_keputusan_pem_edar_alkes_import Izin Produksi Status'));
		$_block->set_config('width', 595);
		if (! $adodb->ErrorMsg()) {
			$_block->parse(array('+<font color=green><b>'.__('Successfull Import').'</b></font>'));
			return $_block->get_str();
		}
		$GLOBALS['self_close_js'] = $GLOBALS['adodb']->ErrorMsg();
		$_block->parse(array('+<font color=red><b>'.__('Failed Import').'</b></font>'));
		return  $_block->get_str();
	}

	// handle list surat_keputusan_pem_edar_alkes_import
	function list_surat_keputusan_pem_edar_alkes_import($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = 'select
		surat_keputusan_pem_edar_alkes_import.id_surat_keputusan_pem_edar_alkes_import,
		surat_keputusan_pem_edar_alkes_import.no_surat_keputusan_pem_edar_alkes_import,
		pendaftar_pem_edar_alkes_import.nama_pabrik,
		surat_keputusan_pem_edar_alkes_import.nip,
		surat_keputusan_pem_edar_alkes_import.nama
		from
		surat_keputusan_pem_edar_alkes_import
		LEFT OUTER JOIN cek_kelengkapan_data_pem_alkes_import ON(cek_kelengkapan_data_pem_alkes_import.id_cek_1 = surat_keputusan_pem_edar_alkes_import.id_cek_1)
		LEFT OUTER JOIN tt_1_pem_edar_alkes_import ON(tt_1_pem_edar_alkes_import.no_tt = cek_kelengkapan_data_pem_alkes_import.no_tt)
		LEFT OUTER JOIN pendaftar_pem_edar_alkes_import ON(pendaftar_pem_edar_alkes_import.kode_pendaftar_pem_edar_alkes_import = tt_1_pem_edar_alkes_import.kode_pendaftar_pem_edar_alkes_import)
		';// where vendor_code=\''.$vendor_code.'\'';


		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_surat_keputusan_pem_edar_alkes_import' => TRUE,
			'surat_keputusan_pem_edar_alkes_import' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'id_surat_keputusan_pem_edar_alkes_import' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' .
			'\', 600, 400, null, null, \'add_surat_keputusan_pem_edar_alkes_import\');'.
			'win.focus()',
			"title"=>__("Add").'Surat keputusan Izin Pemutihan Edar Alkes Import',
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//			if ($this->get_permission('fill_this')) {	'no_rekomendasi' => $_POST['no_rekomendasi'],

//				$add_anchor .= pager::pager_button(array("link"=>'javascript:openIT(\'' . $GLOBALS['PHP_SELF'] .
//				'?action=import' .
//				'\', 600, 400, null, null, \'import_surat_keputusan_pem_edar_alkes_import\');', "title"=>__("Import").' surat_keputusan_pem_edar_alkes_import"', "label"=>__('(I)')));
//			}
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_surat_keputusan_pem_edar_alkes_import\');'.
			'win.focus()',
			"title"=>__("Edit").' Surat keputusan Izin Pemutihan Edar Alkes Import',
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' . 
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_surat_keputusan_pem_edar_alkes_import\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"title"=>__('Delete').' Surat keputusan Izin Pemutihan Edar Alkes Import', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
			$view_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\', 640, 480, null, null, \'view_skk\');'.
			'win.focus()',
			"title"=>__("View").' Surat keputusan Izin Pemutihan Edar Alkes Import',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"link+"));
//		}

		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_surat_keputusan_pem_edar_alkes_import\');'.
			'win.focus()',
			"title"=>__('Print').' Surat keputusan Izin Pemutihan Edar Alkes Import',
			"label"=>__('Print'),
			"type"=>"button",
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->surat_keputusan_pem_edar_alkes_import_label;
		$config = array (
			'id'		=> 'surat_keputusan_pem_edar_alkes_import',
			'db'		=> &$GLOBALS['adodb'],
			'optional_arr'	=> $optional_arr,
			'label_arr'	=> $label_arr,
			'vsel_arr'	=> $vsel_arr,
			'eval_arr'	=> $eval_arr,
			'sql'		=> $sql,
			'extra_param'	=> 'action=find',
			'add_anchor'	=> $add_anchor,
			'edit_anchor'	=> "<nobr>".$edit_anchor."|".$view_anchor,
			'del_anchor'	=> $del_anchor,
			'print_anchor'	=> $print_anchor,
			'pk'		=> $pk,
			'form_width'	=> 595,
			'form_title'	=> __('List').' Surat keputusan Izin Pemutihan Edar Alkes Import'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print surat_keputusan_pem_edar_alkes_import
	function print_surat_keputusan_pem_edar_alkes_import() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_surat_keputusan_pem_edar_alkes_import($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$surat_keputusan_pem_edar_alkes_import_controller = new surat_keputusan_pem_edar_alkes_import_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_keputusan_pem_edar_alkes_import_controller->add_surat_keputusan_pem_edar_alkes_import_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $surat_keputusan_pem_edar_alkes_import_controller->add_surat_keputusan_pem_edar_alkes_import();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_keputusan_pem_edar_alkes_import_controller->update_surat_keputusan_pem_edar_alkes_import_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $surat_keputusan_pem_edar_alkes_import_controller->update_surat_keputusan_pem_edar_alkes_import();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $surat_keputusan_pem_edar_alkes_import_controller->view_surat_keputusan_pem_edar_alkes_import_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $surat_keputusan_pem_edar_alkes_import_controller->delete_surat_keputusan_pem_edar_alkes_import();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_keputusan_pem_edar_alkes_import_controller->import_surat_keputusan_pem_edar_alkes_import_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $surat_keputusan_pem_edar_alkes_import_controller->import_surat_keputusan_pem_edar_alkes_import();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $surat_keputusan_pem_edar_alkes_import_controller->print_surat_keputusan_pem_edar_alkes_import();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $surat_keputusan_pem_edar_alkes_import_controller->list_surat_keputusan_pem_edar_alkes_import();
			include 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Surat keputusan Izin Pemutihan Edar Alkes Import Administration';
	include 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>
