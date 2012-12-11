<?php

	
	require_once 'init.php';
	require_once 'auth.php';

if (class_exists('surat_penolakan_pemutih_controller')) {
	// do nothing
} else if (defined('CLASS_surat_penolakan_pemutih_CONTROLLER')) {
	// do nothing
} else {
	define('CLASS_surat_penolakan_pemutih_CONTROLLER', TRUE);

include_once 'class.surat_penolakan_pemutih.inc.php';
class surat_penolakan_pemutih_controller extends depkes2_manager {
	var $surat_penolakan_pemutih_label;
	var $optional_arr;
	function surat_penolakan_pemutih_controller() {
		$this->surat_penolakan_pemutih_label = array (
			'id_surat_penolakan_pemutih' => 'id_surat_penolakan_pemutih',
			'nomor_menteri' => 'NOMOR',
			'tanggal_menteri' => 'TANGGAL',
			'nomor_surat' => 'Nomor',
			'lampiran_surat' => 'Lampiran',
			'alamat_pabrik' => 'Alamat Pabrik',
			'date_surat' => 'Tanggal Surat',
			'no_pemohon' => 'Nomor Pemohon',
			'date_pemohon' => 'Tgl Pemohon',
			'id_cek_pemutih' => 'Nama Pabrik',
			'kepada_surat' => 'Kepada Yth',
   			'alat' => 'Alat',
			'nomor_surat_tambahan' => 'Nomor Surat Tambahan',
			'lampiran_surat_tambahan' => 'Lampiran Surat Tambahan',
			'date_surat_tambahan' => 'Tanggal Surat Tambahan',
			'di_surat' => 'di',
			'header' => 'Header',
			'isi_1' => '1.',
			'nama_pabrik' => 'Nama Pabrik',
			'id_surat_tambahan_data'=>'Nomor Surat Tambahan Data',
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
			'id_surat_penolakan_pemutih' => FALSE,
			'passwd' => FALSE,
			'name' => FALSE,
			'insert_by' => TRUE,
			'date_insert' => TRUE// could be toupper, tolower, protect, user_defined, user_rules
		);
	}


	// create add surat_penolakan_pemutih form
	function add_surat_penolakan_pemutih_form() {
		include_once 'class.xform.inc.php';
	
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_SESSION, $_GET, $adodb, $ses;
		$record = $_GET;
		$label_arr = $this->surat_penolakan_pemutih_label;
		$optional_arr = $this->optional_arr;

		$field_arr[] = xform::xf('nomor_surat','C','255');
		$field_arr[] = xform::xf('lampiran_surat','C','255');
		$field_arr[] = xform::xf('date_surat','C','255');

//		if (! $this->get_permission('fill_this')) return $this->intruder();

		$field_arr[] = xform::xf('id_cek_pemutih','N','8');
		$field_arr[] = xform::xf('nama','C','255');
		$field_arr[] = xform::xf('nip','C','255');
		$field_arr[] = xform::xf('insert_by','C','255');
		$field_arr[] = xform::xf('date_insert','N','8');



		$rs = $adodb->Execute("SELECT * FROM surat_penolakan_pemutih WHERE id_surat_penolakan_pemutih='{$record['id_surat_penolakan_pemutih']}'");
		if ($rs && ! $rs->EOF) {
			$value_arr = $rs->fields;
			$optional_arr['id_surat_penolakan_pemutih'] = 'protect';
			$mode = 'edit';
			$optional_arr['passwd_rule'] = '';
		} else {
			$value_arr = array ();
			$mode = 'add';
		}
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

		$optional_arr['id_cek_pemutih'] = 'user_defined';
                $arr = array();
                $arr['name'] = 'id_cek_pemutih';
                $arr['selected'] = $value_arr['id_cek_pemutih'];

		if($mode=='add'){
                	$arr['sql'] = 'SELECT
				cek_pemutih_alkes.id_cek_pemutih as val,
    				pendaftar_pemutih.nama_pabrik as txt
			FROM
				cek_pemutih_alkes
			LEFT OUTER JOIN surat_keputusan_pemutih ON(surat_keputusan_pemutih.id_cek_pemutih = cek_pemutih_alkes.id_cek_pemutih)
			LEFT OUTER JOIN tt_pemutih_alkes ON(tt_pemutih_alkes.no_tt = cek_pemutih_alkes.no_tt)
			LEFT OUTER JOIN pendaftar_pemutih ON(pendaftar_pemutih.kode_pendaftar_pemutih = tt_pemutih_alkes.kode_pendaftar_pemutih)
			LEFT OUTER JOIN surat_penolakan_pemutih ON(surat_penolakan_pemutih.id_cek_pemutih = cek_pemutih_alkes.id_cek_pemutih)
			WHERE
			surat_keputusan_pemutih.id_cek_pemutih IS NULL AND surat_penolakan_pemutih.id_cek_pemutih IS NULL
			ORDER BY
				cek_pemutih_alkes.date_insert';
		}else{
			$arr['sql'] = 'SELECT
				cek_pemutih_alkes.id_cek_pemutih as val,
    				pendaftar_pemutih.nama_pabrik as txt
			FROM
				cek_pemutih_alkes
			LEFT OUTER JOIN tt_pemutih_alkes ON(tt_pemutih_alkes.no_tt = cek_pemutih_alkes.no_tt)
			LEFT OUTER JOIN pendaftar_pemutih ON(pendaftar_pemutih.kode_pendaftar_pemutih = tt_pemutih_alkes.kode_pendaftar_pemutih)
			WHERE
			surat_keputusan_pemutih.id_cek_pemutih IS NULL
			ORDER BY
				cek_pemutih_alkes.date_insert';
		}
		
                $value_arr['id_cek_pemutih'] = xform::dbs($arr);
		
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
		$label_arr['form_extra'] .= "<input type=hidden name=oldpkvalue value='{$record['id_surat_penolakan_pemutih']}'>";
		$label_arr['form_title'] = "Form ".ucwords($mode)." Surat Penolakan Pemutihan Izin Produksi";
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


	// create update surat_penolakan_pemutih form
	function update_surat_penolakan_pemutih_form() {
		return $this->add_surat_penolakan_pemutih_form();
	}

	
	function view_surat_penolakan_pemutih_form() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global ${$GLOBALS['session_vars']}, ${$GLOBALS['get_vars']}, $adodb;
		$field_arr = surat_penolakan_pemutih::get_field_set();

		$optional_arr = $this->optional_arr;
		$optional_arr['id_surat_penolakan_pemutih'] = 'protect';

		$record = array (
			'id_surat_penolakan_pemutih' => ${$GLOBALS['get_vars']}['id_surat_penolakan_pemutih']
		);
		$result = surat_penolakan_pemutih::get($record);
		$value_arr = $result[0];
		$label_arr = $this->surat_penolakan_pemutih_label;
		global $adodb;
		
		define('FPDF_FONTPATH','fpdf/font/');
		require('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','A4');
		$pdf->Open();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(180,7,'LAMPIRAN II','T',0,'R');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'LAMPIRAN PERATURAN MENTERI KESEHATAN RI','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'NOMOR','',0,'L');$pdf->cell(100,7,' : 140/MENKES/PER/III/1991','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'TANGGAL','',0,'L');$pdf->Cell(100,7,' : 4 MARET 1991','',0,'L');
		$pdf->Ln(5);
		$pdf->Cell(180,7,'','B',0,'C');
		$pdf->Ln(10);
		$sqlx = "
		SELECT
		surat_penolakan_pemutih.id_surat_penolakan_pemutih,
		surat_penolakan_pemutih.nomor_surat,
		surat_penolakan_pemutih.lampiran_surat,
		surat_penolakan_pemutih.date_surat,
		surat_tambahan_data_pemutih.nomor_surat as nomor_surat_tambahan,
		surat_tambahan_data_pemutih.lampiran_surat as lampiran_surat_tambahan,
		surat_tambahan_data_pemutih.date_surat as date_surat_tambahan,
		surat_tambahan_data_pemutih.alat,
		pendaftar_pemutih.nama_pabrik,
		pendaftar_pemutih.alamat_pabrik,
		surat_penolakan_pemutih.nama,
		surat_penolakan_pemutih.nip,
		surat_penolakan_pemutih.insert_by,
		surat_penolakan_pemutih.date_insert
		FROM surat_penolakan_pemutih
		LEFT OUTER JOIN cek_pemutih_alkes ON(cek_pemutih_alkes.id_cek_pemutih = surat_penolakan_pemutih.id_cek_pemutih)
		LEFT OUTER JOIN tt_pemutih_alkes ON (tt_pemutih_alkes.no_tt = cek_pemutih_alkes.no_tt)
		LEFT OUTER JOIN pendaftar_pemutih ON( pendaftar_pemutih.kode_pendaftar_pemutih = tt_pemutih_alkes.kode_pendaftar_pemutih)
		LEFT OUTER JOIN surat_tambahan_data_pemutih ON(surat_tambahan_data_pemutih.kepada_surat = cek_pemutih_alkes.id_cek_pemutih)
		WHERE
		surat_penolakan_pemutih.id_surat_penolakan_pemutih ='".$_GET['id_surat_penolakan_pemutih']."'
		";
		//print $sqlx;

		$rsx = $adodb->Execute($sqlx);
		$nomor_surat = $rsx->fields['nomor_surat'];
		$lampiran_surat = $rsx->fields['lampiran_surat'];
		$date_surat = $rsx->fields['date_surat'];
		$nama_pabrik = $rsx->fields['nama_pabrik'];
		$alamat_pabrik = $rsx->fields['alamat_pabrik'];
  		if($rsx->fields['alat']==''){$alat = '...................';}else{ $alat=$rsx->fields['alat'];}
		$nomor_surat_tambahan = $rsx->fields['nomor_surat_tambahan'];
		$date_surat_tambahan = $rsx->fields['date_surat_tambahan'];
		$nama = $rsx->fields['nama'];
		$nip = $rsx->fields['nip'];

		$pdf->Cell(30,7,'Nomor','',0,'L');$pdf->Cell(100,7,' : '.$nomor_surat.'','',0,'L');$pdf->Cell(40,7,'Jakarta, '.date('d M Y',$date_surat).'','',0,'R');
		$pdf->Ln(5);
		$pdf->Cell(30,7,'Lampiran','',0,'L');$pdf->Cell(100,7,' : '.$lampiran_surat.'','',0,'L');
		$pdf->Ln();
		$pdf->Cell(30,7,'Perihal','',0,'L');$pdf->Cell(100,7,' : Penolakan Pendaftar Pemutihan','',0,'L'); $pdf->Cell(40,7,'Kepada Yth,','',0,'L');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(130,7,'','',0,'L');$pdf->Cell(40,7,''.$nama_pabrik.'','',0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(5);
		$pdf->Cell(130,7,'','',0,'L');$pdf->Cell(40,7,'di','',0,'L');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(130,7,'','',0,'L');$pdf->Cell(40,7,''.$alamat_pabrik.'','',0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Ln(20);
		$pdf->Cell(180,7,'     Mengingat Saudara belum menyerahkan tambahan data alat kesehatan/Kosmetik/perbekalan','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'kesehatan rumah tangga*, '.$alat.' seperti dimaksud dalam surat kami nomor '.$nomor_surat_tambahan.'','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'tanggal '.date('d M Y',$date_surat_tambahan).', maka sesuai dengan ketentuan yang berlaku, Penolakan Pemutihan tersebut kami tolak.',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'     Apabila Saudara masih  berminat  untuk mendaftar kembali, masih diberi kesempatan melalui','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'Penolakan Pemutihan baru dengan data yang lengkap.','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(180,7,'        Demikian agar maklum,','',0,'L');
		$pdf->Ln(10);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'Direktur Jenderal Pengawasan','',0,'C');
		$pdf->Ln(5);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'Obat dan Makanan','',0,'C');
		$pdf->Ln(20);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'( '.$nama.' )','B',0,'C');
		$pdf->Ln(10);
		$pdf->Cell(100,7,'','',0,'L');$pdf->Cell(80,7,'NIP. '.$nip.'','',0,'C');
		$pdf->Ln(70);
		$pdf->Cell(180,7,'* Coret yang tidak perlu','B',0,'L');


		$pdf->Output();


	}

	// handle event add surat_penolakan_pemutih
	function add_surat_penolakan_pemutih() {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $_POST, $adodb, $ses;
		$record = $_POST;

		$rs = $adodb->Execute("SELECT * FROM surat_penolakan_pemutih WHERE id_surat_penolakan_pemutih = '{$record['oldpkvalue']}'");
		if ($rs && ! $rs->EOF) {
			$record['date_surat'] = $this->parsedate(trim($_POST['date_surat']));
			$adodb->Execute($adodb->GetUpdateSQL($rs, $record, 1));
			$st = "Updated";
		} else {
			$record['date_surat'] = $this->parsedate(trim($_POST['date_surat']));
			$record['insert_by'] = $ses->loginid;
			$record['date_insert'] = time();
			$rs = $adodb->Execute("SELECT * FROM surat_penolakan_pemutih WHERE id_surat_penolakan_pemutih = NULL");
			$adodb->Execute($adodb->GetInsertSQL($rs, $record));
			$st = "Added";
		}
		$status = "Successfull $st '<b>{$record['id_surat_penolakan_pemutih']}</b>'";
		$this->log($status);
		$_block = new block();
		$_block->set_config('title', 'Status Surat Penolakan Pemutihan Izin Produksi');
		$_block->set_config('width', "90%");
		$_block->parse(array("*".$status));
		return $_block->get_str();
	}


	// handle event update surat_penolakan_pemutih
	function update_surat_penolakan_pemutih() {
		return $this->add_surat_penolakan_pemutih();
	}

	// handle delete surat_penolakan_pemutih
	function delete_surat_penolakan_pemutih() {
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
                        $success = $adodb->Execute("delete from surat_penolakan_pemutih where ".$query);

                if ($success){
                        $status = '<font color=green><b>'.__('Successfull Deleted').'</b></font> '.
                                'surat_penolakan_pemutih <font color=red>'.$query.'</font>';
                } else {
                        $GLOBALS['self_close_js'] = $adodb->ErrorMsg();
                        $status = '<font color=red><b>'.__('Failed Deleted').'</b></font> '.
                                'surat_penolakan_pemutih <font color=red>'.$query.'</font>';
                }
                $this->log($status);
		
                $_block = new block();
                $_block->set_config('title', ('Delete Surat Penolakan Pemutihan Izin Produksi'));
                $_block->set_config('width', 595);
                $_block->parse(array("*".$status));
                return $_block->get_str();
	}

	// handle list surat_penolakan_pemutih
	function list_surat_penolakan_pemutih($extra_config='') {
//		if (! $this->get_permission('fill_this')) return $this->intruder();
		global $adodb, ${$GLOBALS['get_vars']};
		$sql = '
		SELECT
		surat_penolakan_pemutih.id_surat_penolakan_pemutih,
		surat_penolakan_pemutih.nomor_surat,
		surat_penolakan_pemutih.lampiran_surat,
		surat_penolakan_pemutih.date_surat,
		cek_pemutih_alkes.no_pemohon,
		cek_pemutih_alkes.date_pemohon,
		pendaftar_pemutih.nama_pabrik,
		pendaftar_pemutih.alamat_pabrik,
		surat_penolakan_pemutih.nama,
		surat_penolakan_pemutih.nip,
		surat_penolakan_pemutih.insert_by,
		surat_penolakan_pemutih.date_insert
		FROM surat_penolakan_pemutih
		LEFT OUTER JOIN cek_pemutih_alkes ON(cek_pemutih_alkes.id_cek_pemutih = surat_penolakan_pemutih.id_cek_pemutih)
		LEFT OUTER JOIN tt_pemutih_alkes ON (tt_pemutih_alkes.no_tt = cek_pemutih_alkes.no_tt)
		LEFT OUTER JOIN pendaftar_pemutih ON( pendaftar_pemutih.kode_pendaftar_pemutih = tt_pemutih_alkes.kode_pendaftar_pemutih)
		';

		$optional_arr = $this->optional_arr;
		$optional_arr['insert_by'] = FALSE;
		$optional_arr['date_insert'] = FALSE;

		$vsel_arr = array (
			'id_surat_penolakan_pemutih' => FALSE,
			'passwd' => TRUE,
			'name' => TRUE,
			'insert_by' => FALSE,
			'date_insert' => FALSE
		);
		$eval_arr = array ();
		$pk = array (
			'id_surat_penolakan_pemutih' => TRUE
		);
//		if ($this->get_permission('fill_this')) {
			$add_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=add' . 
			'\', 600, 400, null, null, \'add_surat_penolakan_pemutih\');'.
			'win.focus()', 
			"label"=>__("Add"),
			"image"=>$GLOBALS['path_theme'].'/images/new.gif',
			"type"=>"button"));
//		}
//		if ($this->get_permission('fill_this')) {
			$edit_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=edit%s\', 600, 400, null, null, \'edit_surat_penolakan_pemutih\');'.
			'win.focus()', 
			"label"=>__('Edit'),
			"image"=>$GLOBALS['path_theme'].'/images/update.gif',
			"type"=>"button"));
//
		$view_anchor = pager::pager_button(array("link"=>'javascript:'.
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=view%s\', 640, 480, null, null, \'view_skk\');'.
			'win.focus()',
			"label"=>__('View'),
			"image"=>$GLOBALS['path_theme'].'/images/word.gif',
			"type"=>"link+"));
//		}
//		if ($this->get_permission('fill_this')) {
			$del_anchor = pager::pager_button(array(
			"link"=>'javascript:confirm(\''.
			__('Confirm Delete').'?\')?(' . 
			'win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=del%s\', 600, 400, null, null, \'del_surat_penolakan_pemutih\')'.
			'win.focus()):' . 
			'alert(\''.__('Cancelling Delete').'\');', 
			"label"=>__('Delete'),
			"image"=>$GLOBALS['path_theme'].'/images/delete.gif',
			"type"=>"button"));
//		}
		$print_anchor = pager::pager_button(array(
			"link"=>'javascript:win=openIT(\'' . $GLOBALS['PHP_SELF'] .
			'?action=print\''.
			', 600, 400, null, null, \'print_surat_penolakan_pemutih\');'.
			'win.focus()', 
			"label"=>__('Print'),
			"type"=>"button", 
			"image"=>$GLOBALS['path_theme'].'/images/print.gif'));

		$label_arr = $this->surat_penolakan_pemutih_label;
		$config = array (
			'id'		=> 'surat_penolakan_pemutih',
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
			'form_title'	=> __('List').' Surat Penolakan Pemutihan Izin Produksi'.' - '.date($GLOBALS['date_format']));
		if (is_array($extra_config)) $config = array_merge($config, $extra_config);
		$_pager = new pager($config);
		return $_pager->render();
	}

	// handle print surat_penolakan_pemutih
	function print_surat_penolakan_pemutih() {
		$config['header_view'] = FALSE;
		$config['add_anchor'] = FALSE;
		$config['del_anchor'] = FALSE;
		$config['edit_anchor'] = FALSE;
		return $this->list_surat_penolakan_pemutih($config);
	}
}

} // end of define

if (! $GLOBALS['_CONTROLLED']) {
	$GLOBALS['_CONTROLLED'] = TRUE;

	$surat_penolakan_pemutih_controller = new surat_penolakan_pemutih_controller();
	$action = ${$GLOBALS['post_vars']}['action'] ? ${$GLOBALS['post_vars']}['action'] : ${$GLOBALS['get_vars']}['action'];
	switch ($action) {
		case 'add':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_penolakan_pemutih_controller->add_surat_penolakan_pemutih_form();
			$out_content .= $back_to_menu;
			break;
		case 'postadd':
			$out_content = $surat_penolakan_pemutih_controller->add_surat_penolakan_pemutih();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'edit':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_penolakan_pemutih_controller->update_surat_penolakan_pemutih_form();
			$out_content .= $back_to_menu;
			break;
		case 'postedit':
			$out_content = $surat_penolakan_pemutih_controller->update_surat_penolakan_pemutih();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'view':
		    	$out_extra_body =  'onLoad="DocumentLoad()"';
		    	$out_content = $surat_penolakan_pemutih_controller->view_surat_penolakan_pemutih_form();
			$out_content .= $back_to_menu;
			echo $out_content;
			exit;
			break;
		case 'del':
			$out_content = $surat_penolakan_pemutih_controller->delete_surat_penolakan_pemutih();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'import':
			$out_extra_body =  'onLoad="DocumentLoad()"';
			$out_content = $surat_penolakan_pemutih_controller->import_surat_penolakan_pemutih_form();
			$out_content .= $back_to_menu;
			break;
		case 'postimport':
			$out_content = $surat_penolakan_pemutih_controller->import_surat_penolakan_pemutih();
			$out_content .= $self_close_js;
			$out_content .= $back_to_menu;
			break;
		case 'print':
			$out_content = $surat_penolakan_pemutih_controller->print_surat_penolakan_pemutih();
			$out_extra_body = 'onLoad=top.window.print()';
			break;
		case 'find':
		default:
			$out_content = $surat_penolakan_pemutih_controller->list_surat_penolakan_pemutih();
			include_once 'depkes2_menu.php';
			exit;
			break;
	}

	$_title = 'Surat Penolakan Pemutihan Izin Produksi Administration';
	include_once 'depkes2_nonmenu.php';
} // end of CONTROLLED
?>
