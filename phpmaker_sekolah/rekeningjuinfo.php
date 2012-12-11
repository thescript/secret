<?php

// Global variable for table object
$rekeningju = NULL;

//
// Table class for rekeningju
//
class crekeningju {
	var $TableVar = 'rekeningju';
	var $TableName = 'rekeningju';
	var $TableType = 'TABLE';
	var $NoRek;
	var $Keterangan;
	var $debet;
	var $kredit;
	var $kode_bukti;
	var $tanggal;
	var $kode_otomatis_master;
	var $tanggal_nota;
	var $kode_otomatis;
	var $kode_otomatis_tingkat;
	var $id;
	var $apakah_original;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $ExportPageBreakCount = 0; // Page break per every n record (PDF only)
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes

	// Reset attributes for table object
	function ResetAttrs() {
		$this->CssClass = "";
		$this->CssStyle = "";
    	$this->RowAttrs = array();
		foreach ($this->fields as $fld) {
			$fld->ResetAttrs();
		}
	}

	// Setup field titles
	function SetupFieldTitles() {
		foreach ($this->fields as &$fld) {
			if (strval($fld->FldTitle()) <> "") {
				$fld->EditAttrs["onmouseover"] = "ew_ShowTitle(this, '" . ew_JsEncode3($fld->FldTitle()) . "');";
				$fld->EditAttrs["onmouseout"] = "ew_HideTooltip();";
			}
		}
	}
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $LastAction; // Last action
	var $CurrentMode = ""; // Current mode
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $AllowAddDeleteRow = TRUE; // Allow add/delete row
	var $DetailAdd = TRUE; // Allow detail add
	var $DetailEdit = FALSE; // Allow detail edit
	var $GridAddRowCount = 2;

	// Check current action
	// - Add
	function IsAdd() {
		return $this->CurrentAction == "add";
	}

	// - Copy
	function IsCopy() {
		return $this->CurrentAction == "copy" || $this->CurrentAction == "C";
	}

	// - Edit
	function IsEdit() {
		return $this->CurrentAction == "edit";
	}

	// - Delete
	function IsDelete() {
		return $this->CurrentAction == "D";
	}

	// - Confirm
	function IsConfirm() {
		return $this->CurrentAction == "F";
	}

	// - Overwrite
	function IsOverwrite() {
		return $this->CurrentAction == "overwrite";
	}

	// - Cancel
	function IsCancel() {
		return $this->CurrentAction == "cancel";
	}

	// - Grid add
	function IsGridAdd() {
		return $this->CurrentAction == "gridadd";
	}

	// - Grid edit
	function IsGridEdit() {
		return $this->CurrentAction == "gridedit";
	}

	// - Insert
	function IsInsert() {
		return $this->CurrentAction == "insert" || $this->CurrentAction == "A";
	}

	// - Update
	function IsUpdate() {
		return $this->CurrentAction == "update" || $this->CurrentAction == "U";
	}

	// - Grid update
	function IsGridUpdate() {
		return $this->CurrentAction == "gridupdate";
	}

	// - Grid insert
	function IsGridInsert() {
		return $this->CurrentAction == "gridinsert";
	}

	// - Grid overwrite
	function IsGridOverwrite() {
		return $this->CurrentAction == "gridoverwrite";
	}

	// Check last action
	// - Cancelled
	function IsCanceled() {
		return $this->LastAction == "cancel" && $this->CurrentAction == "";
	}

	// - Inline inserted
	function IsInlineInserted() {
		return $this->LastAction == "insert" && $this->CurrentAction == "";
	}

	// - Inline updated
	function IsInlineUpdated() {
		return $this->LastAction == "update" && $this->CurrentAction == "";
	}

	// - Grid updated
	function IsGridUpdated() {
		return $this->LastAction == "gridupdate" && $this->CurrentAction == "";
	}

	// - Grid inserted
	function IsGridInserted() {
		return $this->LastAction == "gridinsert" && $this->CurrentAction == "";
	}

	//
	// Table class constructor
	//
	function crekeningju() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// NoRek
		$this->NoRek = new cField('rekeningju', 'rekeningju', 'x_NoRek', 'NoRek', '`NoRek`', 200, -1, FALSE, '`NoRek`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['NoRek'] =& $this->NoRek;

		// Keterangan
		$this->Keterangan = new cField('rekeningju', 'rekeningju', 'x_Keterangan', 'Keterangan', '`Keterangan`', 200, -1, FALSE, '`Keterangan`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['Keterangan'] =& $this->Keterangan;

		// debet
		$this->debet = new cField('rekeningju', 'rekeningju', 'x_debet', 'debet', '`debet`', 5, -1, FALSE, '`debet`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->debet->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['debet'] =& $this->debet;

		// kredit
		$this->kredit = new cField('rekeningju', 'rekeningju', 'x_kredit', 'kredit', '`kredit`', 5, -1, FALSE, '`kredit`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->kredit->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['kredit'] =& $this->kredit;

		// kode_bukti
		$this->kode_bukti = new cField('rekeningju', 'rekeningju', 'x_kode_bukti', 'kode_bukti', '`kode_bukti`', 200, -1, FALSE, '`kode_bukti`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_bukti'] =& $this->kode_bukti;

		// tanggal
		$this->tanggal = new cField('rekeningju', 'rekeningju', 'x_tanggal', 'tanggal', '`tanggal`', 135, 7, FALSE, '`tanggal`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->tanggal->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['tanggal'] =& $this->tanggal;

		// kode_otomatis_master
		$this->kode_otomatis_master = new cField('rekeningju', 'rekeningju', 'x_kode_otomatis_master', 'kode_otomatis_master', '`kode_otomatis_master`', 200, -1, FALSE, '`kode_otomatis_master`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_otomatis_master'] =& $this->kode_otomatis_master;

		// tanggal_nota
		$this->tanggal_nota = new cField('rekeningju', 'rekeningju', 'x_tanggal_nota', 'tanggal_nota', '`tanggal_nota`', 133, 7, FALSE, '`tanggal_nota`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->tanggal_nota->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['tanggal_nota'] =& $this->tanggal_nota;

		// kode_otomatis
		$this->kode_otomatis = new cField('rekeningju', 'rekeningju', 'x_kode_otomatis', 'kode_otomatis', '`kode_otomatis`', 200, -1, FALSE, '`kode_otomatis`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_otomatis'] =& $this->kode_otomatis;

		// kode_otomatis_tingkat
		$this->kode_otomatis_tingkat = new cField('rekeningju', 'rekeningju', 'x_kode_otomatis_tingkat', 'kode_otomatis_tingkat', '`kode_otomatis_tingkat`', 200, -1, FALSE, '`kode_otomatis_tingkat`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['kode_otomatis_tingkat'] =& $this->kode_otomatis_tingkat;

		// id
		$this->id = new cField('rekeningju', 'rekeningju', 'x_id', 'id', '`id`', 21, -1, FALSE, '`id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// apakah_original
		$this->apakah_original = new cField('rekeningju', 'rekeningju', 'x_apakah_original', 'apakah_original', '`apakah_original`', 200, -1, FALSE, '`apakah_original`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['apakah_original'] =& $this->apakah_original;
	}

	// Get field values
	function GetFieldValues($propertyname) {
		$values = array();
		foreach ($this->fields as $fldname => $fld)
			$values[$fldname] =& $fld->$propertyname;
		return $values;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "rekeningju_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function getMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "master_transaksi2") {
			if ($this->kode_otomatis_master->getSessionValue() <> "")
				$sMasterFilter .= "`kode_otomatis`=" . ew_QuotedValue($this->kode_otomatis_master->getSessionValue(), EW_DATATYPE_STRING);
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function getDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "master_transaksi2") {
			if ($this->kode_otomatis_master->getSessionValue() <> "")
				$sDetailFilter .= "`kode_otomatis_master`=" . ew_QuotedValue($this->kode_otomatis_master->getSessionValue(), EW_DATATYPE_STRING);
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_master_transaksi2() {
		return "`kode_otomatis`='@kode_otomatis@'";
	}

	// Detail filter
	function SqlDetailFilter_master_transaksi2() {
		return "`kode_otomatis_master`='@kode_otomatis_master@'";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`rekeningju`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = " NoRek<>'sementara' ";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "`id` DESC";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `rekeningju` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `rekeningju` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `rekeningju` WHERE ";
		$SQL .= ew_QuotedName('kode_otomatis') . '=' . ew_QuotedValue($rs['kode_otomatis'], $this->kode_otomatis->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`kode_otomatis` = '@kode_otomatis@'";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@kode_otomatis@", ew_AdjustSql($this->kode_otomatis->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "rekeningjulist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "rekeningjulist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("rekeningjuview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "rekeningjuadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("rekeningjuedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("rekeningjuadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("rekeningjudelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->kode_otomatis->CurrentValue)) {
			$sUrl .= "kode_otomatis=" . urlencode($this->kode_otomatis->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=rekeningju" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["kode_otomatis"]; // kode_otomatis

			//return $arKeys; // do not return yet, so the values will also be checked by the following code
		}

		// check keys
		$ar = array();
		foreach ($arKeys as $key) {
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->kode_otomatis->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->NoRek->setDbValue($rs->fields('NoRek'));
		$this->Keterangan->setDbValue($rs->fields('Keterangan'));
		$this->debet->setDbValue($rs->fields('debet'));
		$this->kredit->setDbValue($rs->fields('kredit'));
		$this->kode_bukti->setDbValue($rs->fields('kode_bukti'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->kode_otomatis_master->setDbValue($rs->fields('kode_otomatis_master'));
		$this->tanggal_nota->setDbValue($rs->fields('tanggal_nota'));
		$this->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
		$this->kode_otomatis_tingkat->setDbValue($rs->fields('kode_otomatis_tingkat'));
		$this->id->setDbValue($rs->fields('id'));
		$this->apakah_original->setDbValue($rs->fields('apakah_original'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// NoRek
		// Keterangan
		// debet
		// kredit
		// kode_bukti
		// tanggal
		// kode_otomatis_master

		$this->kode_otomatis_master->CellCssStyle = "white-space: nowrap;";

		// tanggal_nota
		// kode_otomatis

		$this->kode_otomatis->CellCssStyle = "white-space: nowrap;";

		// kode_otomatis_tingkat
		$this->kode_otomatis_tingkat->CellCssStyle = "white-space: nowrap;";

		// id
		$this->id->CellCssStyle = "white-space: nowrap;";

		// apakah_original
		// NoRek

		if (strval($this->NoRek->CurrentValue) <> "") {
			$sFilterWrk = "`Norek` = '" . ew_AdjustSql($this->NoRek->CurrentValue) . "'";
		$sSqlWrk = "SELECT `Norek`, `Keterangan` FROM `rekening2`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Norek` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->NoRek->ViewValue = $rswrk->fields('Norek');
				$this->NoRek->ViewValue .= ew_ValueSeparator(0,1,$this->NoRek) . $rswrk->fields('Keterangan');
				$rswrk->Close();
			} else {
				$this->NoRek->ViewValue = $this->NoRek->CurrentValue;
			}
		} else {
			$this->NoRek->ViewValue = NULL;
		}
		$this->NoRek->ViewCustomAttributes = "";

		// Keterangan
		$this->Keterangan->ViewValue = $this->Keterangan->CurrentValue;
		$this->Keterangan->ViewCustomAttributes = "";

		// debet
		$this->debet->ViewValue = $this->debet->CurrentValue;
		$this->debet->ViewCustomAttributes = "";

		// kredit
		$this->kredit->ViewValue = $this->kredit->CurrentValue;
		$this->kredit->ViewCustomAttributes = "";

		// kode_bukti
		$this->kode_bukti->ViewValue = $this->kode_bukti->CurrentValue;
		$this->kode_bukti->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = ew_FormatDateTime($this->tanggal->ViewValue, 7);
		$this->tanggal->ViewCustomAttributes = "";

		// kode_otomatis_master
		$this->kode_otomatis_master->ViewValue = $this->kode_otomatis_master->CurrentValue;
		$this->kode_otomatis_master->ViewCustomAttributes = "";

		// tanggal_nota
		$this->tanggal_nota->ViewValue = $this->tanggal_nota->CurrentValue;
		$this->tanggal_nota->ViewValue = ew_FormatDateTime($this->tanggal_nota->ViewValue, 7);
		$this->tanggal_nota->ViewCustomAttributes = "";

		// kode_otomatis
		$this->kode_otomatis->ViewValue = $this->kode_otomatis->CurrentValue;
		$this->kode_otomatis->ViewCustomAttributes = "";

		// kode_otomatis_tingkat
		$this->kode_otomatis_tingkat->ViewValue = $this->kode_otomatis_tingkat->CurrentValue;
		$this->kode_otomatis_tingkat->ViewCustomAttributes = "";

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// apakah_original
		$this->apakah_original->ViewValue = $this->apakah_original->CurrentValue;
		$this->apakah_original->ViewCustomAttributes = "";

		// NoRek
		$this->NoRek->LinkCustomAttributes = "";
		$this->NoRek->HrefValue = "";
		$this->NoRek->TooltipValue = "";

		// Keterangan
		$this->Keterangan->LinkCustomAttributes = "";
		$this->Keterangan->HrefValue = "";
		$this->Keterangan->TooltipValue = "";

		// debet
		$this->debet->LinkCustomAttributes = "";
		$this->debet->HrefValue = "";
		$this->debet->TooltipValue = "";

		// kredit
		$this->kredit->LinkCustomAttributes = "";
		$this->kredit->HrefValue = "";
		$this->kredit->TooltipValue = "";

		// kode_bukti
		$this->kode_bukti->LinkCustomAttributes = "";
		$this->kode_bukti->HrefValue = "";
		$this->kode_bukti->TooltipValue = "";

		// tanggal
		$this->tanggal->LinkCustomAttributes = "";
		$this->tanggal->HrefValue = "";
		$this->tanggal->TooltipValue = "";

		// kode_otomatis_master
		$this->kode_otomatis_master->LinkCustomAttributes = "";
		$this->kode_otomatis_master->HrefValue = "";
		$this->kode_otomatis_master->TooltipValue = "";

		// tanggal_nota
		$this->tanggal_nota->LinkCustomAttributes = "";
		$this->tanggal_nota->HrefValue = "";
		$this->tanggal_nota->TooltipValue = "";

		// kode_otomatis
		$this->kode_otomatis->LinkCustomAttributes = "";
		$this->kode_otomatis->HrefValue = "";
		$this->kode_otomatis->TooltipValue = "";

		// kode_otomatis_tingkat
		$this->kode_otomatis_tingkat->LinkCustomAttributes = "";
		$this->kode_otomatis_tingkat->HrefValue = "";
		$this->kode_otomatis_tingkat->TooltipValue = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// apakah_original
		$this->apakah_original->LinkCustomAttributes = "";
		$this->apakah_original->HrefValue = "";
		$this->apakah_original->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Export data in Xml Format
	function ExportXmlDocument(&$XmlDoc, $HasParent, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$XmlDoc)
			return;
		if (!$HasParent)
			$XmlDoc->AddRoot($this->TableVar);

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if ($HasParent)
					$XmlDoc->AddRow($this->TableVar);
				else
					$XmlDoc->AddRow();
				if ($ExportPageType == "view") {
					$XmlDoc->AddField('NoRek', $this->NoRek->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('Keterangan', $this->Keterangan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('debet', $this->debet->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kredit', $this->kredit->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_bukti', $this->kode_bukti->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tanggal', $this->tanggal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tanggal_nota', $this->tanggal_nota->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_otomatis', $this->kode_otomatis->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('apakah_original', $this->apakah_original->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('NoRek', $this->NoRek->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('Keterangan', $this->Keterangan->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('debet', $this->debet->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kredit', $this->kredit->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_bukti', $this->kode_bukti->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tanggal', $this->tanggal->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tanggal_nota', $this->tanggal_nota->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('kode_otomatis', $this->kode_otomatis->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('apakah_original', $this->apakah_original->ExportValue($this->Export, $this->ExportOriginalValue));
				}
			}
			$Recordset->MoveNext();
		}
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;

		// Write header
		$Doc->ExportTableHeader();
		if ($Doc->Horizontal) { // Horizontal format, write header
			$Doc->BeginExportRow();
			if ($ExportPageType == "view") {
				$Doc->ExportCaption($this->NoRek);
				$Doc->ExportCaption($this->Keterangan);
				$Doc->ExportCaption($this->debet);
				$Doc->ExportCaption($this->kredit);
				$Doc->ExportCaption($this->kode_bukti);
				$Doc->ExportCaption($this->tanggal);
				$Doc->ExportCaption($this->tanggal_nota);
				$Doc->ExportCaption($this->kode_otomatis);
				$Doc->ExportCaption($this->apakah_original);
			} else {
				$Doc->ExportCaption($this->NoRek);
				$Doc->ExportCaption($this->Keterangan);
				$Doc->ExportCaption($this->debet);
				$Doc->ExportCaption($this->kredit);
				$Doc->ExportCaption($this->kode_bukti);
				$Doc->ExportCaption($this->tanggal);
				$Doc->ExportCaption($this->tanggal_nota);
				$Doc->ExportCaption($this->kode_otomatis);
				$Doc->ExportCaption($this->apakah_original);
			}
			if ($this->Export == "pdf") {
				$Doc->EndExportRow(TRUE);
			} else {
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break for PDF
				if ($this->Export == "pdf" && $this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
					$Doc->ExportField($this->NoRek);
					$Doc->ExportField($this->Keterangan);
					$Doc->ExportField($this->debet);
					$Doc->ExportField($this->kredit);
					$Doc->ExportField($this->kode_bukti);
					$Doc->ExportField($this->tanggal);
					$Doc->ExportField($this->tanggal_nota);
					$Doc->ExportField($this->kode_otomatis);
					$Doc->ExportField($this->apakah_original);
				} else {
					$Doc->ExportField($this->NoRek);
					$Doc->ExportField($this->Keterangan);
					$Doc->ExportField($this->debet);
					$Doc->ExportField($this->kredit);
					$Doc->ExportField($this->kode_bukti);
					$Doc->ExportField($this->tanggal);
					$Doc->ExportField($this->tanggal_nota);
					$Doc->ExportField($this->kode_otomatis);
					$Doc->ExportField($this->apakah_original);
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}
		$Doc->ExportTableFooter();
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

		// Row Inserting event
function Row_Inserting($rsold, &$rsnew) {
	
	$katasql="SELECT tipe_transaksi FROM master_transaksi WHERE " . 
		"  kode_otomatis='" . $rsnew["kode_otomatis_master"] . "' " ;
		
	$nilai=ew_ExecuteScalar($katasql);
	
	if($nilai !="manual")
	{
		 $this->CancelMessage="Maaf,Hanya Jenis Transaksi Manual Saja Yang Bisa Ditambahkan...";
		 return FALSE;
	}
	
	return TRUE;
}

		// Row Inserted event
function Row_Inserted($rsold, &$rsnew) {
	//echo "Row Inserted"   ;
	global $conn;
	$katasql="DELETE FROM rekeningJU WHERE NoRek='sementara' AND " . 
		" kode_otomatis_master='" . $rsnew["kode_otomatis_master"] . "' " ;
		
	$conn->Execute($katasql);
}                       

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}
}
?>
