<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "st_master_tingkatinfo.php" ?>
<?php include_once "penggunainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$st_master_tingkat_add = new cst_master_tingkat_add();
$Page =& $st_master_tingkat_add;

// Page init
$st_master_tingkat_add->Page_Init();

// Page main
$st_master_tingkat_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var st_master_tingkat_add = new ew_Page("st_master_tingkat_add");

// page properties
st_master_tingkat_add.PageID = "add"; // page ID
st_master_tingkat_add.FormID = "fst_master_tingkatadd"; // form ID
var EW_PAGE_ID = st_master_tingkat_add.PageID; // for backward compatibility

// extend page with ValidateForm function
st_master_tingkat_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_tingkat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_tingkat->tingkat->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_apakah_disembunyikan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($st_master_tingkat->apakah_disembunyikan->FldCaption()) ?>");

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
st_master_tingkat_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
st_master_tingkat_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
st_master_tingkat_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
st_master_tingkat_add.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
st_master_tingkat_add.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $st_master_tingkat->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $st_master_tingkat->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $st_master_tingkat_add->ShowPageHeader(); ?>
<?php
$st_master_tingkat_add->ShowMessage();
?>
<form name="fst_master_tingkatadd" id="fst_master_tingkatadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return st_master_tingkat_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="st_master_tingkat">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($st_master_tingkat->tingkat->Visible) { // tingkat ?>
	<tr id="r_tingkat"<?php echo $st_master_tingkat->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_tingkat->tingkat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_master_tingkat->tingkat->CellAttributes() ?>><span id="el_tingkat">
<input type="text" name="x_tingkat" id="x_tingkat" size="30" maxlength="50" value="<?php echo $st_master_tingkat->tingkat->EditValue ?>"<?php echo $st_master_tingkat->tingkat->EditAttributes() ?>>
</span><?php echo $st_master_tingkat->tingkat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($st_master_tingkat->apakah_disembunyikan->Visible) { // apakah_disembunyikan ?>
	<tr id="r_apakah_disembunyikan"<?php echo $st_master_tingkat->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $st_master_tingkat->apakah_disembunyikan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $st_master_tingkat->apakah_disembunyikan->CellAttributes() ?>><span id="el_apakah_disembunyikan">
<select id="x_apakah_disembunyikan" name="x_apakah_disembunyikan"<?php echo $st_master_tingkat->apakah_disembunyikan->EditAttributes() ?>>
<?php
if (is_array($st_master_tingkat->apakah_disembunyikan->EditValue)) {
	$arwrk = $st_master_tingkat->apakah_disembunyikan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($st_master_tingkat->apakah_disembunyikan->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $st_master_tingkat->apakah_disembunyikan->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_kode_otomatis" id="x_kode_otomatis" value="<?php echo ew_HtmlEncode($st_master_tingkat->kode_otomatis->CurrentValue) ?>">
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$st_master_tingkat_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$st_master_tingkat_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cst_master_tingkat_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'st_master_tingkat';

	// Page object name
	var $PageObjName = 'st_master_tingkat_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $st_master_tingkat;
		if ($st_master_tingkat->UseTokenInUrl) $PageUrl .= "t=" . $st_master_tingkat->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $st_master_tingkat;
		if ($st_master_tingkat->UseTokenInUrl) {
			if ($objForm)
				return ($st_master_tingkat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($st_master_tingkat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cst_master_tingkat_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (st_master_tingkat)
		if (!isset($GLOBALS["st_master_tingkat"])) {
			$GLOBALS["st_master_tingkat"] = new cst_master_tingkat();
			$GLOBALS["Table"] =& $GLOBALS["st_master_tingkat"];
		}

		// Table object (pengguna)
		if (!isset($GLOBALS['pengguna'])) $GLOBALS['pengguna'] = new cpengguna();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'st_master_tingkat', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $st_master_tingkat;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("st_master_tingkatlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $st_master_tingkat;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$st_master_tingkat->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$st_master_tingkat->CurrentAction = "I"; // Form error, reset action
				$st_master_tingkat->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["kode_otomatis"] != "") {
				$st_master_tingkat->kode_otomatis->setQueryStringValue($_GET["kode_otomatis"]);
				$st_master_tingkat->setKey("kode_otomatis", $st_master_tingkat->kode_otomatis->CurrentValue); // Set up key
			} else {
				$st_master_tingkat->setKey("kode_otomatis", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$st_master_tingkat->CurrentAction = "C"; // Copy record
			} else {
				$st_master_tingkat->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($st_master_tingkat->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("st_master_tingkatlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$st_master_tingkat->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $st_master_tingkat->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "st_master_tingkatview.php")
						$sReturnUrl = $st_master_tingkat->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$st_master_tingkat->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$st_master_tingkat->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$st_master_tingkat->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $st_master_tingkat;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $st_master_tingkat;
		$st_master_tingkat->tingkat->CurrentValue = $_SESSION['kode_otomatis_tingkat'];
		$st_master_tingkat->apakah_disembunyikan->CurrentValue = NULL;
		$st_master_tingkat->apakah_disembunyikan->OldValue = $st_master_tingkat->apakah_disembunyikan->CurrentValue;
		$st_master_tingkat->kode_otomatis->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $st_master_tingkat;
		if (!$st_master_tingkat->tingkat->FldIsDetailKey) {
			$st_master_tingkat->tingkat->setFormValue($objForm->GetValue("x_tingkat"));
		}
		if (!$st_master_tingkat->apakah_disembunyikan->FldIsDetailKey) {
			$st_master_tingkat->apakah_disembunyikan->setFormValue($objForm->GetValue("x_apakah_disembunyikan"));
		}
		if (!$st_master_tingkat->kode_otomatis->FldIsDetailKey) {
			$st_master_tingkat->kode_otomatis->setFormValue($objForm->GetValue("x_kode_otomatis"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $st_master_tingkat;
		$this->LoadOldRecord();
		$st_master_tingkat->tingkat->CurrentValue = $st_master_tingkat->tingkat->FormValue;
		$st_master_tingkat->apakah_disembunyikan->CurrentValue = $st_master_tingkat->apakah_disembunyikan->FormValue;
		$st_master_tingkat->kode_otomatis->CurrentValue = $st_master_tingkat->kode_otomatis->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $st_master_tingkat;
		$sFilter = $st_master_tingkat->KeyFilter();

		// Call Row Selecting event
		$st_master_tingkat->Row_Selecting($sFilter);

		// Load SQL based on filter
		$st_master_tingkat->CurrentFilter = $sFilter;
		$sSql = $st_master_tingkat->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $st_master_tingkat;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$st_master_tingkat->Row_Selected($row);
		$st_master_tingkat->tingkat->setDbValue($rs->fields('tingkat'));
		$st_master_tingkat->apakah_disembunyikan->setDbValue($rs->fields('apakah_disembunyikan'));
		$st_master_tingkat->kode_otomatis->setDbValue($rs->fields('kode_otomatis'));
	}

	// Load old record
	function LoadOldRecord() {
		global $st_master_tingkat;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($st_master_tingkat->getKey("kode_otomatis")) <> "")
			$st_master_tingkat->kode_otomatis->CurrentValue = $st_master_tingkat->getKey("kode_otomatis"); // kode_otomatis
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$st_master_tingkat->CurrentFilter = $st_master_tingkat->KeyFilter();
			$sSql = $st_master_tingkat->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $st_master_tingkat;

		// Initialize URLs
		// Call Row_Rendering event

		$st_master_tingkat->Row_Rendering();

		// Common render codes for all row types
		// tingkat
		// apakah_disembunyikan
		// kode_otomatis

		if ($st_master_tingkat->RowType == EW_ROWTYPE_VIEW) { // View row

			// tingkat
			$st_master_tingkat->tingkat->ViewValue = $st_master_tingkat->tingkat->CurrentValue;
			$st_master_tingkat->tingkat->ViewCustomAttributes = "";

			// apakah_disembunyikan
			if (strval($st_master_tingkat->apakah_disembunyikan->CurrentValue) <> "") {
				switch ($st_master_tingkat->apakah_disembunyikan->CurrentValue) {
					case "y":
						$st_master_tingkat->apakah_disembunyikan->ViewValue = $st_master_tingkat->apakah_disembunyikan->FldTagCaption(1) <> "" ? $st_master_tingkat->apakah_disembunyikan->FldTagCaption(1) : $st_master_tingkat->apakah_disembunyikan->CurrentValue;
						break;
					case "t":
						$st_master_tingkat->apakah_disembunyikan->ViewValue = $st_master_tingkat->apakah_disembunyikan->FldTagCaption(2) <> "" ? $st_master_tingkat->apakah_disembunyikan->FldTagCaption(2) : $st_master_tingkat->apakah_disembunyikan->CurrentValue;
						break;
					default:
						$st_master_tingkat->apakah_disembunyikan->ViewValue = $st_master_tingkat->apakah_disembunyikan->CurrentValue;
				}
			} else {
				$st_master_tingkat->apakah_disembunyikan->ViewValue = NULL;
			}
			$st_master_tingkat->apakah_disembunyikan->ViewCustomAttributes = "";

			// kode_otomatis
			$st_master_tingkat->kode_otomatis->ViewValue = $st_master_tingkat->kode_otomatis->CurrentValue;
			$st_master_tingkat->kode_otomatis->ViewCustomAttributes = "";

			// tingkat
			$st_master_tingkat->tingkat->LinkCustomAttributes = "";
			$st_master_tingkat->tingkat->HrefValue = "";
			$st_master_tingkat->tingkat->TooltipValue = "";

			// apakah_disembunyikan
			$st_master_tingkat->apakah_disembunyikan->LinkCustomAttributes = "";
			$st_master_tingkat->apakah_disembunyikan->HrefValue = "";
			$st_master_tingkat->apakah_disembunyikan->TooltipValue = "";

			// kode_otomatis
			$st_master_tingkat->kode_otomatis->LinkCustomAttributes = "";
			$st_master_tingkat->kode_otomatis->HrefValue = "";
			$st_master_tingkat->kode_otomatis->TooltipValue = "";
		} elseif ($st_master_tingkat->RowType == EW_ROWTYPE_ADD) { // Add row

			// tingkat
			$st_master_tingkat->tingkat->EditCustomAttributes = "";
			$st_master_tingkat->tingkat->EditValue = ew_HtmlEncode($st_master_tingkat->tingkat->CurrentValue);

			// apakah_disembunyikan
			$st_master_tingkat->apakah_disembunyikan->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("y", $st_master_tingkat->apakah_disembunyikan->FldTagCaption(1) <> "" ? $st_master_tingkat->apakah_disembunyikan->FldTagCaption(1) : "y");
			$arwrk[] = array("t", $st_master_tingkat->apakah_disembunyikan->FldTagCaption(2) <> "" ? $st_master_tingkat->apakah_disembunyikan->FldTagCaption(2) : "t");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$st_master_tingkat->apakah_disembunyikan->EditValue = $arwrk;

			// kode_otomatis
			$st_master_tingkat->kode_otomatis->EditCustomAttributes = "";
			$st_master_tingkat->kode_otomatis->CurrentValue = 0;

			// Edit refer script
			// tingkat

			$st_master_tingkat->tingkat->HrefValue = "";

			// apakah_disembunyikan
			$st_master_tingkat->apakah_disembunyikan->HrefValue = "";

			// kode_otomatis
			$st_master_tingkat->kode_otomatis->HrefValue = "";
		}
		if ($st_master_tingkat->RowType == EW_ROWTYPE_ADD ||
			$st_master_tingkat->RowType == EW_ROWTYPE_EDIT ||
			$st_master_tingkat->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$st_master_tingkat->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($st_master_tingkat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$st_master_tingkat->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $st_master_tingkat;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($st_master_tingkat->tingkat->FormValue) && $st_master_tingkat->tingkat->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_tingkat->tingkat->FldCaption());
		}
		if (!is_null($st_master_tingkat->apakah_disembunyikan->FormValue) && $st_master_tingkat->apakah_disembunyikan->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $st_master_tingkat->apakah_disembunyikan->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $st_master_tingkat;

		// Check if key value entered
		if ($st_master_tingkat->kode_otomatis->CurrentValue == "" && $st_master_tingkat->kode_otomatis->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $st_master_tingkat->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $st_master_tingkat->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_master_tingkat->tingkat->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(tingkat = '" . ew_AdjustSql($st_master_tingkat->tingkat->CurrentValue) . "')";
			$rsChk = $st_master_tingkat->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'tingkat', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_master_tingkat->tingkat->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($st_master_tingkat->kode_otomatis->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(kode_otomatis = '" . ew_AdjustSql($st_master_tingkat->kode_otomatis->CurrentValue) . "')";
			$rsChk = $st_master_tingkat->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'kode_otomatis', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $st_master_tingkat->kode_otomatis->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// tingkat
		$st_master_tingkat->tingkat->SetDbValueDef($rsnew, $st_master_tingkat->tingkat->CurrentValue, "", FALSE);

		// apakah_disembunyikan
		$st_master_tingkat->apakah_disembunyikan->SetDbValueDef($rsnew, $st_master_tingkat->apakah_disembunyikan->CurrentValue, "", FALSE);

		// kode_otomatis
		$st_master_tingkat->kode_otomatis->SetDbValueDef($rsnew, $st_master_tingkat->kode_otomatis->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $st_master_tingkat->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($st_master_tingkat->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($st_master_tingkat->CancelMessage <> "") {
				$this->setFailureMessage($st_master_tingkat->CancelMessage);
				$st_master_tingkat->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$st_master_tingkat->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
