
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/pdfviewer/web/viewer.js"></script>

<style type="text/css">
  .label_class{
    color: #333;
    margin-bottom: 0px;
  }
  .form-control .input-sm{
    margin-top: 0px;
  }
  form .form-group {
    margin: 0px 0 0;
  }
  #list  p {
    font: arial;
    font-size: 14px;
    /*background-color: yellow ;*/
  }
  #tabDiv{
    padding-right: 0px;
  }
  .container-fluid{
    padding: 0px;
  }
</style>

<input type="hidden" name="PDF" id="DocumentURL" value="<?php echo $docPDF['DocumentURL'];?>">

<div class="row" id="loadcontent">
  <input type="text" name="message" id="message" value="<?php echo $this->session->userdata('message');?>">
  <div class="col-md-12 col-sm-12">
    <form class="form" id="fupForm"  enctype="multipart/form-data" style="display: none;">

      <div class="form-group">
        <div class="col-md-4">
          <div class="input-group input-file" name="file">
            <input type="text" class="form-control" name="file"  placeholder='Select Loan Package' required="true" />     
            <span class="input-group-btn">
              <button type="button" class="btn btn-space btn-social btn-color btn-twitter single_submit" value="1" id="upload" style=" background: #f44336 !important;">Upload<div class="ripple-container"></div></button>
            </span>


          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<div class="row">
 <div class="col-sm-4 col-md-4" id="tabDiv">

  <div class="legend is-inlined">
    <div><span style="padding: 0;border: none;"></span><span style="    font-size: 13px;font-weight: bold;">Page Confidence:</span></div>
    <div><span style="background: #0080009c;"></span><span style="    font-size: 13px;font-weight: bold;">>75</span></div>
    <div><span style="background: #0000ff38"></span><span style="    font-size: 13px;font-weight: bold;">50 - 75</span></div>
    <div><span style="background: #ffa5005c"></span><span style="    font-size: 13px;font-weight: bold;"><50</span></div>
    <div><span style="background: #fff"></span><span style="    font-size: 13px;font-weight: bold;">?</span></div>
  </div>
  <div   id="append_content">

  </div>


  <div class="table-responsive" style=" max-height: 550px;
  overflow-y: auto;">
  <?php $count_green=0;
  $total_classified=0;
  $color;
  $count_oge=0;
  $count_white=0;
  $count_purple=0; ?>
  <table id="table_conf">
    <thead>
      <tr>
        <th scope="col" colspan="2">Page No</th>
        <th scope="col" colspan="1">Manual</th>
        <th scope="col" colspan="1">Auto</th>
        <th scope="col" colspan="1" title="Page Confidence">%</th>
      </tr>
    </thead>
    <tbody >
      <?php 

      if($pages){ 

        foreach ($pages as $r) {
          $ocrCategoryName='';$CategoryName='';
          foreach ($DocumentType as $c) {
            if ($c['DocumentTypeUID'] == $r['ocrDocumentTypeUID']) {
              $ocrCategoryName=$c['DocumentTypeName'];
            }

          }

          if(($r['pageConfidence']*100) >= 75 || ($r['pageConfidence']*100) == 0 && ($r['pageConfidence']) !=NULL){ 
            $count_green++;
            $total_classified++;
            $color='#0080009c';
          }else if(($r['pageConfidence']*100) >=50 && ($r['pageConfidence']*100) <75){ 
            $count_purple++;
            $total_classified++;
            $color='#0000ff38';
          }else if(($r['pageConfidence']*100) < 50 && ($r['pageConfidence']*100) !=0 && ($r['pageConfidence']) != NULL ){ 
            $count_oge++;
            $color='#ffa5005c';
          }else if(($r['pageConfidence']) == NULL){
            $count_white++;
            $color='#fff';
          } 
          ?>
          <tr id="<?php echo $r['PageNo'];?>">

            <input type="hidden" value="<?php echo $r['DocumentTypeUID'];?>" name="DocumentTypeUID" id="DocumentTypeUID-<?php echo $r['PageNo'];?>">
            <td style="font-weight: 700;font-size: 12px;color: #000;" class="tpage_no">
              <i class="fa fa-file" data-pageNo="<?php echo $r['PageNo'];?>"></i>
            </td>
            <td style="font-weight: 700;font-size: 12px;color: #000;" class="tpage_no"> <?php echo $r['PageNo'];?></td>
            <td class="item-stock" style="font-size: 10px;color: #000;"><?php echo $r['DocumentTypeName'];?></td>
            <td class="item-stock" id="ocrCategoryName-<?php echo $r['PageNo'];?>" style="font-size: 10px;color: #000;">
              <select id="manualOCR-<?php echo $r['PageNo'];?>" class="form-control manualOCR item-stock" style="margin: 0px;height: 30px;">
                <option value="0">Select Doc Type</option>
                <?php 
                foreach ($DocumentType as $c) {
                  if ($r['manualDocumentTypeUID']!='') {

                    if ($c['DocumentTypeUID'] == $r['manualDocumentTypeUID']) { ?>
                      <option value="<?php echo $c['DocumentTypeUID'];?>" selected><?php echo $c['DocumentTypeName'];?></option>
                    <?php } else { ?> 
                      <option value="<?php echo $c['DocumentTypeUID'];?>" ><?php echo $c['DocumentTypeName'];?></option>
                    <?php } 
                  }else {

                    if ($c['DocumentTypeUID'] == $r['ocrDocumentTypeUID']) { ?>
                      <option value="<?php echo $c['DocumentTypeUID'];?>" selected><?php echo $c['DocumentTypeName'];?></option>
                    <?php } else { ?> 
                      <option value="<?php echo $c['DocumentTypeUID'];?>" ><?php echo $c['DocumentTypeName'];?></option>
                    <?php }
                  } } ?>
                </select>
              </td>
              <td class="item-stock" id="pageConfidence-<?php echo $r['PageNo'];?>" onclick="docDef('<?php echo $ocrCategoryName;?>','<?php echo $r['PageNo'];?>');" style="background:<?php echo $color;?> ; font-size: 12px;color: #000;">
                <?php 
                if ($r['pageConfidence']==NULL){
                  echo "";
                } else { 
                  echo round($r['pageConfidence']*100);
                } 
                ?>
              </td>
            </tr>
          <?php }
        } ?>
      </tbody>
    </table>    

  </div>
  <br>
  <div class="legend is-inlined">
    <div><span style="padding: 0;border: none;"></span><span style="    font-size: 13px;font-weight: bold;">Summary : </span></div>
    <div><span style="background: #0080009c;"></span><span style="    font-size: 13px;font-weight: bold;" class="count_green"><?php echo $count_green;?></span></div>
    <div><span style="background: #0000ff38"></span><span style="    font-size: 13px;font-weight: bold;" class="count_purple"><?php echo $count_purple;?></span></div>
    <div><span style="background: #ffa5005c"></span><span style="    font-size: 13px;font-weight: bold;" class="count_oge"><?php echo $count_oge;?></span></div>
    <div><span style="background: #fff"></span><span style="    font-size: 13px;font-weight: bold;" class="count_white"><?php echo $count_white;?></span></div>
  </div>
  <div class="legend is-inlined">
    <div><span style="padding: 0;border: none;"></span><span style="    font-size: 13px;font-weight: bold;">Total Pages : <?php echo count($pages);?></span></div>

    <div><span style="padding: 0;border: none;"></span><span style="    font-size: 13px;font-weight: bold;" class="total_classified">Total Classified : <?php echo $total_classified;?></span></div>
    <div><button type="button" class="btn btn-info"  data-toggle="modal" data-target="#sumModal">Document Summary</button></div>

  </div>
</div>


<!-- PDF VIEWER STARTS-->

<div class="col-md-8" style="">


  <!-- pdf viewer starts -->

  <div id="outerContainer" style="display: block;">

    <div id="sidebarContainer">
      <div id="toolbarSidebar">
        <div class="splitToolbarButton toggled">
          <button id="viewThumbnail" class="toolbarButton toggled" title="Show Thumbnails" tabindex="2" data-l10n-id="thumbs">
           <span data-l10n-id="thumbs_label">Thumbnails</span>
         </button>
         <button id="viewOutline" class="toolbarButton" title="Show Document Outline (double-click to expand/collapse all items)" tabindex="3" data-l10n-id="document_outline">
           <span data-l10n-id="document_outline_label">Document Outline</span>
         </button>
         <button id="viewAttachments" class="toolbarButton" title="Show Attachments" tabindex="4" data-l10n-id="attachments">
           <span data-l10n-id="attachments_label">Attachments</span>
         </button>
       </div>
     </div>
     <div id="sidebarContent">
      <div id="thumbnailView">
      </div>
      <div id="outlineView" class="hidden">
      </div>
      <div id="attachmentsView" class="hidden">
      </div>
    </div>
  </div>  <!-- sidebarContainer -->

  <div id="mainContainer">
    <div class="findbar hidden doorHanger" id="findbar">
      <div id="findbarInputContainer">
        <input id="findInput" class="toolbarField" title="Find" placeholder="Find in document…" tabindex="91" data-l10n-id="find_input">
        <div class="splitToolbarButton">
          <button id="findPrevious" class="toolbarButton findPrevious" title="Find the previous occurrence of the phrase" tabindex="92" data-l10n-id="find_previous">
            <span data-l10n-id="find_previous_label">Previous</span>
          </button>
          <div class="splitToolbarButtonSeparator"></div>
          <button id="findNext" class="toolbarButton findNext" title="Find the next occurrence of the phrase" tabindex="93" data-l10n-id="find_next">
            <span data-l10n-id="find_next_label">Next</span>
          </button>
        </div>
      </div>

      <div id="findbarOptionsContainer">
        <input type="checkbox" id="findHighlightAll" class="toolbarField" tabindex="94">
        <label for="findHighlightAll" class="toolbarLabel" data-l10n-id="find_highlight">Highlight all</label>
        <input type="checkbox" id="findMatchCase" class="toolbarField" tabindex="95">
        <label for="findMatchCase" class="toolbarLabel" data-l10n-id="find_match_case_label">Match case</label>
        <span id="findResultsCount" class="toolbarLabel hidden"></span>
      </div>

      <div id="findbarMessageContainer">
        <span id="findMsg" class="toolbarLabel"></span>
      </div>
    </div>  <!-- findbar -->

    <div id="secondaryToolbar" class="secondaryToolbar hidden doorHangerRight">
      <div id="secondaryToolbarButtonContainer">
        <button id="secondaryPresentationMode" class="secondaryToolbarButton presentationMode visibleLargeView" title="Switch to Presentation Mode" tabindex="51" data-l10n-id="presentation_mode">
          <span data-l10n-id="presentation_mode_label">Presentation Mode</span>
        </button>

        <button id="secondaryOpenFile" class="secondaryToolbarButton openFile visibleLargeView" title="Open File" tabindex="52" data-l10n-id="open_file">
          <span data-l10n-id="open_file_label">Open</span>
        </button>

        <button id="secondaryPrint" class="secondaryToolbarButton print visibleMediumView" title="Print" tabindex="53" data-l10n-id="print">
          <span data-l10n-id="print_label">Print</span>
        </button>

        <button id="secondaryDownload" class="secondaryToolbarButton download visibleMediumView" title="Download" tabindex="54" data-l10n-id="download">
          <span data-l10n-id="download_label">Download</span>
        </button>

        <a href="javascript:void(0)" id="secondaryViewBookmark" class="secondaryToolbarButton bookmark visibleSmallView" title="Current view (copy or open in new window)" tabindex="55" data-l10n-id="bookmark">
          <span data-l10n-id="bookmark_label">Current View</span>
        </a>

        <div class="horizontalToolbarSeparator visibleLargeView"></div>

        <button id="firstPage" class="secondaryToolbarButton firstPage" title="Go to First Page" tabindex="56" data-l10n-id="first_page">
          <span data-l10n-id="first_page_label">Go to First Page</span>
        </button>
        <button id="lastPage" class="secondaryToolbarButton lastPage" title="Go to Last Page" tabindex="57" data-l10n-id="last_page">
          <span data-l10n-id="last_page_label">Go to Last Page</span>
        </button>

        <div class="horizontalToolbarSeparator"></div>

        <button id="pageRotateCw" class="secondaryToolbarButton rotateCw" title="Rotate Clockwise" tabindex="58" data-l10n-id="page_rotate_cw">
          <span data-l10n-id="page_rotate_cw_label">Rotate Clockwise</span>
        </button>
        <button id="pageRotateCcw" class="secondaryToolbarButton rotateCcw" title="Rotate Counterclockwise" tabindex="59" data-l10n-id="page_rotate_ccw">
          <span data-l10n-id="page_rotate_ccw_label">Rotate Counterclockwise</span>
        </button>

        <div class="horizontalToolbarSeparator"></div>

        <button id="cursorSelectTool" class="secondaryToolbarButton selectTool toggled" title="Enable Text Selection Tool" tabindex="60" data-l10n-id="cursor_text_select_tool">
          <span data-l10n-id="cursor_text_select_tool_label">Text Selection Tool</span>
        </button>
        <button id="cursorHandTool" class="secondaryToolbarButton handTool" title="Enable Hand Tool" tabindex="61" data-l10n-id="cursor_hand_tool">
          <span data-l10n-id="cursor_hand_tool_label">Hand Tool</span>
        </button>

        <div class="horizontalToolbarSeparator"></div>

        <button id="documentProperties" class="secondaryToolbarButton documentProperties" title="Document Properties…" tabindex="62" data-l10n-id="document_properties">
          <span data-l10n-id="document_properties_label">Document Properties…</span>
        </button>
      </div>
    </div>  <!-- secondaryToolbar -->

    <div class="toolbar">
      <div id="toolbarContainer">
        <div id="toolbarViewer">
          <div id="toolbarViewerLeft">
            <button id="sidebarToggle" class="toolbarButton" title="Toggle Sidebar" tabindex="11" data-l10n-id="toggle_sidebar">
              <span data-l10n-id="toggle_sidebar_label">Toggle Sidebar</span>
            </button>
            <div class="toolbarButtonSpacer"></div>
            <button id="viewFind" class="toolbarButton" title="Find in Document" tabindex="12" data-l10n-id="findbar">
              <span data-l10n-id="findbar_label">Find</span>
            </button>
            <div class="splitToolbarButton hiddenSmallView">
              <button class="toolbarButton pageUp" title="Previous Page" id="previous" tabindex="13" data-l10n-id="previous">
                <span data-l10n-id="previous_label">Previous</span>
              </button>
              <div class="splitToolbarButtonSeparator"></div>
              <button class="toolbarButton pageDown" title="Next Page" id="next" tabindex="14" data-l10n-id="next">
                <span data-l10n-id="next_label">Next</span>
              </button>
            </div>
            <input type="number" id="pageNumber" class="toolbarField pageNumber" title="Page" value="1" size="4" min="1" tabindex="15" data-l10n-id="page">
            <span id="numPages" class="toolbarLabel"></span>
          </div>
          <div id="toolbarViewerRight">
            <button id="presentationMode" class="toolbarButton presentationMode hiddenLargeView" title="Switch to Presentation Mode" tabindex="31" data-l10n-id="presentation_mode">
              <span data-l10n-id="presentation_mode_label">Presentation Mode</span>
            </button>

            <button id="openFile" class="toolbarButton openFile hiddenLargeView" title="Open File" tabindex="32" data-l10n-id="open_file">
              <span data-l10n-id="open_file_label">Open</span>
            </button>

            <button id="print" class="toolbarButton print hiddenMediumView" title="Print" tabindex="33" data-l10n-id="print">
              <span data-l10n-id="print_label">Print</span>
            </button>

            <button id="download" class="toolbarButton download hiddenMediumView" title="Download" tabindex="34" data-l10n-id="download">
              <span data-l10n-id="download_label">Download</span>
            </button>
            <a href="javascript:void(0)" id="viewBookmark" class="toolbarButton bookmark hiddenSmallView" title="Current view (copy or open in new window)" tabindex="35" data-l10n-id="bookmark">
              <span data-l10n-id="bookmark_label">Current View</span>
            </a>

            <div class="verticalToolbarSeparator hiddenSmallView"></div>

            <button id="secondaryToolbarToggle" class="toolbarButton" title="Tools" tabindex="36" data-l10n-id="tools">
              <span data-l10n-id="tools_label">Tools</span>
            </button>
          </div>
          <div id="toolbarViewerMiddle">
            <div class="splitToolbarButton">
              <button id="zoomOut" class="toolbarButton zoomOut" title="Zoom Out" tabindex="21" data-l10n-id="zoom_out">
                <span data-l10n-id="zoom_out_label">Zoom Out</span>
              </button>
              <div class="splitToolbarButtonSeparator"></div>
              <button id="zoomIn" class="toolbarButton zoomIn" title="Zoom In" tabindex="22" data-l10n-id="zoom_in">
                <span data-l10n-id="zoom_in_label">Zoom In</span>
              </button>
            </div>
            <span id="scaleSelectContainer" class="dropdownToolbarButton">
              <select id="scaleSelect" title="Zoom" tabindex="23" data-l10n-id="zoom">
                <option id="pageAutoOption" title="" value="auto" selected="selected" data-l10n-id="page_scale_auto">Automatic Zoom</option>
                <option id="pageActualOption" title="" value="page-actual" data-l10n-id="page_scale_actual">Actual Size</option>
                <option id="pageFitOption" title="" value="page-fit" data-l10n-id="page_scale_fit">Page Fit</option>
                <option id="pageWidthOption" title="" value="page-width" data-l10n-id="page_scale_width">Page Width</option>
                <option id="customScaleOption" title="" value="custom" disabled="disabled" hidden="true"></option>
                <option title="" value="0.5" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 50 }'>50%</option>
                <option title="" value="0.75" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 75 }'>75%</option>
                <option title="" value="1" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 100 }'>100%</option>
                <option title="" value="1.25" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 125 }'>125%</option>
                <option title="" value="1.5" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 150 }'>150%</option>
                <option title="" value="2" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 200 }'>200%</option>
                <option title="" value="3" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 300 }'>300%</option>
                <option title="" value="4" data-l10n-id="page_scale_percent" data-l10n-args='{ "scale": 400 }'>400%</option>
              </select>
            </span>
          </div>
        </div>
        <div id="loadingBar">
          <div class="progress">
            <div class="glimmer">
            </div>
          </div>
        </div>
      </div>
    </div>

    <menu type="context" id="viewerContextMenu">
      <menuitem id="contextFirstPage" label="First Page"
      data-l10n-id="first_page"></menuitem>
      <menuitem id="contextLastPage" label="Last Page"
      data-l10n-id="last_page"></menuitem>
      <menuitem id="contextPageRotateCw" label="Rotate Clockwise"
      data-l10n-id="page_rotate_cw"></menuitem>
      <menuitem id="contextPageRotateCcw" label="Rotate Counter-Clockwise"
      data-l10n-id="page_rotate_ccw"></menuitem>
    </menu>

    <div id="viewerContainer" tabindex="0">
      <div id="viewer" class="pdfViewer"></div>
    </div>

    <div id="errorWrapper" hidden='true'>
      <div id="errorMessageLeft">
        <span id="errorMessage"></span>
        <button id="errorShowMore" data-l10n-id="error_more_info">
          More Information
        </button>
        <button id="errorShowLess" data-l10n-id="error_less_info" hidden='true'>
          Less Information
        </button>
      </div>
      <div id="errorMessageRight">
        <button id="errorClose" data-l10n-id="error_close">
          Close
        </button>
      </div>
      <div class="clearBoth"></div>
      <textarea id="errorMoreInfo" hidden='true' readonly="readonly"></textarea>
    </div>
  </div> <!-- mainContainer -->

  <div id="overlayContainer" class="hidden">
    <div id="passwordOverlay" class="container hidden">
      <div class="dialog">
        <div class="pdfviewerrow">
          <p id="passwordText" data-l10n-id="password_label">Enter the password to open this PDF file:</p>
        </div>
        <div class="pdfviewerrow">
          <input type="password" id="password" class="toolbarField">
        </div>
        <div class="buttonRow">
          <button id="passwordCancel" class="overlayButton"><span data-l10n-id="password_cancel">Cancel</span></button>
          <button id="passwordSubmit" class="overlayButton"><span data-l10n-id="password_ok">OK</span></button>
        </div>
      </div>
    </div>
    <div id="documentPropertiesOverlay" class="container hidden">
      <div class="dialog">
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_file_name">File name:</span> <p id="fileNameField">-</p>
        </div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_file_size">File size:</span> <p id="fileSizeField">-</p>
        </div>
        <div class="separator"></div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_title">Title:</span> <p id="titleField">-</p>
        </div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_author">Author:</span> <p id="authorField">-</p>
        </div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_subject">Subject:</span> <p id="subjectField">-</p>
        </div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_keywords">Keywords:</span> <p id="keywordsField">-</p>
        </div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_creation_date">Creation Date:</span> <p id="creationDateField">-</p>
        </div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_modification_date">Modification Date:</span> <p id="modificationDateField">-</p>
        </div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_creator">Creator:</span> <p id="creatorField">-</p>
        </div>
        <div class="separator"></div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_producer">PDF Producer:</span> <p id="producerField">-</p>
        </div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_version">PDF Version:</span> <p id="versionField">-</p>
        </div>
        <div class="pdfviewerrow">
          <span data-l10n-id="document_properties_page_count">Page Count:</span> <p id="pageCountField">-</p>
        </div>
        <div class="buttonRow">
          <button id="documentPropertiesClose" class="overlayButton"><span data-l10n-id="document_properties_close">Close</span></button>
        </div>
      </div>
    </div>
    <div id="printServiceOverlay" class="container hidden">
      <div class="dialog">
        <div class="pdfviewerrow">
          <span data-l10n-id="print_progress_message">Preparing document for printing…</span>
        </div>
        <div class="pdfviewerrow">
          <progress value="0" max="100"></progress>
          <span data-l10n-id="print_progress_percent" data-l10n-args='{ "progress": 0 }' class="relative-progress">0%</span>
        </div>
        <div class="buttonRow">
          <button id="printCancel" class="overlayButton"><span data-l10n-id="print_progress_close">Cancel</span></button>
        </div>
      </div>
    </div>
  </div>  <!-- overlayContainer -->

</div> <!-- outerContainer -->


<div id="printContainer"></div>

<!-- pdf viewer end -->
</div>

<!-- PDF VIEWER ENDS -->
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="    max-width: 70%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add/Edit Keywords</h4>
      </div>
      <div class="modal-body" >
        <form role="form" id="modal_form">
         <input type="hidden" name="docdef_id" id="docdef_id" value="">
         <input type="hidden" name="filename" id="filename" value="<?php echo $this->uri->segment(5);?>">
         <input type="hidden" name="OrderNumber" id="OrderNumber" value="<?php echo $this->uri->segment(3);?>">
         <input type="hidden" name="OrderUID" id="OrderUID" value="<?php echo $this->uri->segment(4);?>">
         <input type="hidden" name="pageNo" id="pageNo" class="form-control input-sm" value="">
         <div class="row">
          <div class="col-xs-4 col-sm-4 col-md-4">
            <label class="label_class">Document Type:</label>

            <div class="form-group">

              <select name="ocrDocType" id="ocrDocType" class="form-control input-sm" title="Select Doc Type">

                <option value="0">Select Doc Type</option>
                <?php foreach ($DocumentType as $c): ?>
                  <option value="<?php echo $c['DocumentTypeUID'];?>"><?php echo $c['DocumentTypeName'];?></option>
                <?php endforeach ?>

              </select>
            </div>
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4">
            <label class="label_class">Document Type UID:</label>

            <div class="form-group">

              <input type="text" name="docTypeUID" id="docTypeUID" class="form-control input-sm" placeholder="Document Type UID" title="Document Type UID" readonly="true">
            </div>
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4">
            <label class="label_class">Header Length:</label>
            <div class="form-group">

              <input type="text" name="header_length" id="header_length" class="form-control input-sm" placeholder="Header Length" title="Header Length">
            </div>
          </div>

        </div>
        <div class="row">

          <div class="col-xs-3 col-sm-3 col-md-3">
            <label class="label_class">Footer Length:</label>
            <div class="form-group">
              <input type="text" name="footer_length" id="footer_length" class="form-control input-sm" placeholder="Footer Length" title="Footer Length">
            </div>
          </div>

          <div class="col-xs-3 col-sm-3 col-md-3">
            <label class="label_class">Min Confidence:</label>
            <div class="form-group">
              <input type="text" name="min_confidence" id="min_confidence" class="form-control input-sm" placeholder="Min Confidence" title="Min Confidence">
            </div>
          </div>
          <div class="col-xs-3 col-sm-3 col-md-3">
            <label class="label_class">KeyWord CutOff:</label>
            <div class="form-group">
              <input type="text" name="KeyWordCutOff" id="KeyWordCutOff" class="form-control input-sm" placeholder="KeyWord CutOff" title="Key Word CutOff">
            </div>
          </div>

          <div class="col-xs-3 col-sm-3 col-md-3">
            <label class="label_class">LowerCase Search:</label>
            <div class="form-group">
              <input type="text" name="LowerCaseSearch" id="LowerCaseSearch" class="form-control input-sm" placeholder="LowerCase Search" title="Lower Case Search">
            </div>
          </div>
        </div>

        <h4 class="modal-title">Mandatory Keywords</h4>
        <div class="row">
          <input type="hidden" name="is_mandatory" id="is_mandatory-0" value="1">
          <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
              <select id="0" name="headerTypes" class="form-control input-sm" title="Mandatory Keyword Type">
                <option value="">Type</option>
                <?php foreach ($types as $t): ?>
                  <option value="<?php echo $t['PageSectionUID'];?>"><?php echo $t['SectionName'];?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control input-sm" id="Dockeywords-0" name="Dockeywords" value="" placeholder="Enter Keywords" title="Mandatory Keywords">
                <div class="input-group-btn">
                  <button class="btn btn-success" type="button"  onclick="append_newmand_fields();"> <span class="fa fa-plus" aria-hidden="true"></span> </button>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div id="append_mand_fields"></div>
        <div id="append_newmand_fields"></div>


        <h4 class="modal-title">Keywords</h4>
        <div class="row">
          <input type="hidden" name="is_mandatory" id="is_mandatory-headerTypes-0" value="0">
          <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
              <select id="headerTypes-0" name="headerTypes" class="form-control input-sm" title="Keywords Type">
                <option value="">Type</option>
                <?php foreach ($types as $t): ?>
                  <option value="<?php echo $t['PageSectionUID'];?>"><?php echo $t['SectionName'];?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control input-sm" id="Dockeywords-headerTypes-0" name="Dockeywords1" value="" placeholder="Enter Keywords" title="Keywords">
                <div class="input-group-btn">
                  <button class="btn btn-success" type="button"  onclick="append_newkey_fields();"> <span class="fa fa-plus" aria-hidden="true"></span> </button>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div id="append_key_fields"></div>
        <div id="append_newkey_fields"></div>

        <div class="row col-md-12">
          <div class="col-md-3">
            <input type="button" value="Same DocType Same Page" id="sdsm" class="update btn btn-info btn-block" data-val="1">
          </div>

          <div class="col-md-3">
            <input type="button" value="Same DocType All Page" id="sdap" class="update btn btn-info btn-block" data-val=2>
          </div>

          <div class="col-md-3">
            <input type="button" value="All DocType Same Page" id="adsp" class="update btn btn-info btn-block" data-val="3">
          </div>

          <div class="col-md-3">
            <input type="button" value="All DocType All Page" id="adap" class="update btn btn-info btn-block" data-val="4">
          </div>
        </div>


      </form>
    </div>

  </div>

</div>
</div>

<!-- Summary Modal -->
<div id="sumModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="    max-width: 70%;">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">OCR Summary</h4>
      </div>
      <div class="modal-body" >
        <table class="table table-bordered" id="summaryTable">
          <thead>
            <th>Sl.No</th>
            <th>Document Type</th>
            <th>Manual Count</th>
            <th>OCR Count</th>
          </thead>
          <tbody>
            <?php $row=1;foreach ($ocrDocuments as $d): ?>
            <?php $manual=0;$ocr=0; $manual_total=0; $ocr_total=0; foreach ($pages as $p): ?>

            <?php if ($p['ocrDocumentTypeUID'] == $d['DocumentTypeUID']): ?>
              <?php $ocr_total=$ocr_total+1;?>
            <?php  endif ?>

            <?php if ($p['DocumentTypeUID'] == $d['DocumentTypeUID']): ?>
              <?php $manual_total=$manual_total+1;?>
            <?php  endif ?>

          <?php  endforeach ?>
          <tr>
            <td><?php echo $row;?></td>
            <td><?php echo $d['DocumentTypeName'];?></td>
            <td><?php echo $manual_total;?></td>
            <td><?php echo $ocr_total;?></td>
          </tr>
          <?php $row++; endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div> 
<!--Summary Modal ends  -->

<!-- Text File Modal -->
<div id="fileModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Text Data</h4>
      </div>
      <div class="modal-body">
        <div id="list">

        </div>
      </div>
    </div>

  </div>
</div>
<!--Text File Modal ends  -->
</div>

<script type="text/javascript">

  var click=0;

  var pdf_url;
  var tpage_num=1;
  var file='';

</script>

<script type="text/javascript">
  var page='';
  var Document=$("#DocumentURL").val();

  const base_url = 'http://localhost/Insig/';

  var MENU_URL='';
  var DEFAULT_URL = base_url+Document;
  //console.log(DEFAULT_URL)

  $(function () {
    PDFJS.getDocument({ url: DEFAULT_URL }).then(function(pdf_doc) {
      pagecount = pdf_doc.numPages;
    });
  })

  $("#data tr td").on("click", function() {
    $(this).parent().next("tr").toggleClass("active");
  });

  $('.tpage_no').click(function() {
    console.log("Page");
    var pageno= $(this).closest('tr').attr('id');
    PDFViewerApplication.pdfViewer.currentPageNumber = Number(pageno);
  });

</script>

<script type="text/javascript">
  // $(document).ready(function(){
  //   $("#table_conf").DataTable({"paging":   false,
  //     "info":     false,
  //     "searching": false,
  //     "scrollY": 450,
  //   });
  // });
  
</script> 


<script type="text/javascript">
  var keyword = 0;
  function docDef(ocrDocType,pageNo){
   // $("#modal_form")[0].reset();
    if($("#docTypeUID").val() != 0){
      $("#ocrDocType").attr("disabled", true);
    }else{
      $("#ocrDocType").attr("disabled", false);
    }
    $("#append_mand_fields").empty('');
    $("#append_key_fields").empty('');
    var ocrDocType=$("#manualOCR-"+pageNo+" :selected").val();
    var DocumentTypeUID = $('#manualOCR-'+pageNo+' :selected').val();
    $("#docTypeUID").val(ocrDocType);
    $("#ocrDocType1").val(ocrDocType);
    $("#myModal").modal('show');
    $("#ocrDocType1").val(DocumentTypeUID);
    $("#pageNo").val(pageNo);
    $("#myModal").modal('show');
    // $("#ocrDocType > option").each(function(){     
    //   if($(this).val()==DocumentTypeUID){ // EDITED THIS LINE
    //     //console.log($(this).val()+"fhfh"+DocumentTypeUID);
    //     $(this).attr("selected","selected");    
    //   }    
    // });
    $("#ocrDocType").val(DocumentTypeUID);
    $.ajax({
      type:'post',
      url:'<?php echo base_url();?>main/getDocDef',
      dataType:'json',
      data:{'docTypeUID':DocumentTypeUID},
      success:function(data){
        console.log(data)
        if (data) {
          if (data.docdef) {
            $("#docdef_id").val(data.docdef.DocDefUID);
          }else{
            $("#docdef_id").val('');
          }
          $("#docTypeUID").val(data.docdef.DocTypeUID);
          $("#min_confidence").val(data.docdef.MinConfidence*100);
          $("#header_length").val(data.docdef.HeaderLen);
          $("#footer_length").val(data.docdef.FooterLen);
          $("#KeyWordCutOff").val(data.docdef.KeyWordCutOff);
          $("#LowerCaseSearch").val(data.docdef.LowerCaseSearch);
          
          // $("#divToReload_WithDAta").load(location.href + " #divToReload_WithDAta"); 
          if (data.keywords) {
            for (var i = 0; i < data.keywords.length; i++) {
              var elements='';
              for (var j = 0; j < data.types.length; j++) {
                if (data.types[j].SectionName==data.keywords[i].KeyType) {
                  elements+='<option value="'+data.types[j].PageSectionUID+'" selected>'+data.types[j].SectionName+'</option>';
                  
                }else{
                 elements+='<option value="'+data.types[j].PageSectionUID+'">'+data.types[j].SectionName+'</option>';
               }
             }

             keyword=data.keywords[i].KeywordUID;
             if (data.keywords[i].IsMandatory == 1) {
              var objTo = document.getElementById('append_mand_fields')
              var divtest = document.createElement("div");
              divtest.setAttribute("class", "row removeclass"+keyword);
              var rdiv = 'removeclass'+keyword;
              divtest.innerHTML = '<input type="hidden" name="is_mandatory" id="is_mandatory-'+keyword+'" value="1"><div class="col-sm-4 nopadding"><div class="form-group"><select class="form-control" id="'+keyword+'" name="headerTypes">'+elements+'</select></div></div><div class="col-sm-8 nopadding"><div class="form-group"><div class="input-group">  <input type="text" class="form-control" id="Dockeywords-'+keyword+'" name="Dockeywords" value="'+data.keywords[i].Keywords+'" placeholder="Enter Keywords"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_mand_fields('+ keyword +');"> <span class="fa fa-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';
              objTo.appendChild(divtest)
              $("#"+keyword).html(elements);
            }

            if (data.keywords[i].IsMandatory == 0) {
              var objTo = document.getElementById('append_key_fields')
              var divtest = document.createElement("div");
              divtest.setAttribute("class", "row removeclass"+keyword);
              var rdiv = 'removeclass'+keyword;
              divtest.innerHTML = '<input type="hidden" name="is_mandatory" id="is_mandatory-headerTypes-'+keyword+'" value="0"><div class="col-sm-4 nopadding"><div class="form-group"><select class="form-control" id="headerTypes-'+keyword+'" name="headerTypes"></select></div></div><div class="col-sm-8 nopadding"><div class="form-group"><div class="input-group">  <input type="text" class="form-control" id="Dockeywords-headerTypes-'+keyword+'" name="Dockeywords" value="'+data.keywords[i].Keywords+'" placeholder="Enter Keywords"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_mand_fields('+ keyword +');"> <span class="fa fa-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';

              objTo.appendChild(divtest)
              $("#headerTypes-"+keyword).html(elements);
            }
          }
        }

          //console.log(keyword)
        }else{
          $("#docdef_id").val('');
        }
      },
      error:function(error,errorThrown){
        console.log(error)
      }
    })
return false;
}


function append_newmand_fields() {
  keyword++;
  var objTo = document.getElementById('append_newmand_fields')
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "row removeclass"+keyword);
  var rdiv = 'removeclass'+keyword;
  divtest.innerHTML = '<input type="hidden" name="is_mandatory" id="is_mandatory-'+keyword+'" value="1"><div class="col-sm-4 nopadding"><div class="form-group"><select class="form-control" id="'+keyword+'" name="headerTypes"><option value="">Type</option><option value="Header">Header</option> <option value="Body">Body</option><option value="Footer">Footer</option></select></div></div><div class="col-sm-8 nopadding"><div class="form-group"><div class="input-group">  <input type="text" class="form-control" id="Dockeywords-'+keyword+'" name="Dockeywords" value="" placeholder="Enter Keywords"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_mand_fields('+ keyword +');"> <span class="fa fa-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';

  if ($("#0").val()!='') {
    objTo.appendChild(divtest)
  }else{
    toastr.error("Please choose keyword type");
  }
}


function remove_mand_fields(rid) {
  $('.removeclass'+rid).remove();
  keyword--;
}


function append_newkey_fields() {
  keyword++;
  var objTo = document.getElementById('append_newkey_fields')
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "row removeclass"+keyword);
  var rdiv = 'removeclass'+keyword;
  divtest.innerHTML = '<input type="hidden" name="is_mandatory" id="is_mandatory-headerTypes-'+keyword+'" value="0"><div class="col-sm-4 nopadding"><div class="form-group"><select class="form-control" id="headerTypes-'+keyword+'" name="headerTypes"><option value="">Type</option><option value="Header">Header</option> <option value="Body">Body</option><option value="Footer">Footer</option></select></div></div><div class="col-sm-8 nopadding"><div class="form-group"><div class="input-group">  <input type="text" class="form-control" id="Dockeywords-headerTypes-'+keyword+'" name="Dockeywords" value="" placeholder="Enter Keywords"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_key_fields('+ keyword +');"> <span class="fa fa-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';

  if ($("#headerTypes-0").val()!='') {
    objTo.appendChild(divtest)
  }else{
    toastr.error("Please choose keyword type");
  }
}

function remove_key_fields(rid) {
  $('.removeclass'+rid).remove();
  keyword--;
}


</script>


<script type="text/javascript">
  $(".manualOCR").on('change',function(){
    var pageNo= $(this).closest('tr').attr('id');
    var OrderUID=$("#OrderUID").val();
    var manualOCR=$("#manualOCR-"+pageNo +" :selected").val();
    console.log(pageNo+" "+OrderUID+" "+manualOCR);
    $.ajax({
      type:'post',
      url:"<?php echo base_url();?>main/updateManualTPages",
      dataType:'json',
      data:{'OrderUID':OrderUID,'pageNo':pageNo,'manualOCR':manualOCR},
      success:function(data){
        if (data) {
          toastr.success('Document type set successfully');
        }
      },
      error:function(error){
        console.log(error);
      }
    });
  })

  $(".fa-file").click(function(){
    $("#list").empty();
    var PageNo = $(this).attr('data-pageNo');
    var filename= $("#filename").val();
    var filename=filename.split('.');
    $("#fileModal").modal('show');
    $("#list").append('<p><iframe src="<?php echo base_url();?>uploads/OrderDocumentPath/<?php echo $this->uri->segment(3);?>/text/'+filename[0]+'-'+PageNo+'.txt" frameborder="0" height="400" width="95%"></iframe></p>');
  })
</script>


<script type="text/javascript">

  $(".update").on('click',function(){
    if ($("#docdef_id").val()!='') {
      var docdef_id=$("#docdef_id").val();
    }else{
      var docdef_id='';
    }
    var ocrType=$(this).attr('data-val');
    console.log(ocrType);
    var docTypeUID=$("#docTypeUID").val();
    var min_confidence=$("#min_confidence").val()/100;
    var header_length=$("#header_length").val();
    var footer_length=$("#footer_length").val();
    var ocrDocType=$("#ocrDocType :selected").text();
    var file=$("#filename").val();
    var OrderNumber=$("#OrderNumber").val();
    var OrderUID=$("#OrderUID").val();
    var pageNo=$("#pageNo").val();
    var KeyWordCutOff=$("#KeyWordCutOff").val();
    var LowerCaseSearch=$("#LowerCaseSearch").val();
    var degree='';
    var headerTypes='';
    var header_enum='';
    var body_enum='';
    var footer_enum='';
    var header_mand_enum='';
    var body_mand_enum='';
    var footer_mand_enum='';
    var header_key='';
    var footer_key='';
    var body_key='';
    var header_mand_key='';
    var body_mand_key='';
    var footer_mand_key='';
    var mand_key_array =0;
    var key_array =0;
    var header_mand_key_array =new Array();
    var header_key_array =[];
    var keywords='';
    var docDef='';
    var MandatoryKeywordsCount=1;
    var KeywordsCount=1;
    var mand='';
    var normal='';
    var count_mand=0;
    var count_norm=0;
    var MandatoryKeywordsCount=0;
    var KeywordsCount=0;
    var words =[];
    var words1 =[];
    $("select[name=headerTypes]").each(function(){
     headerTypes= $(this).attr('id');

     if ($("#is_mandatory-"+headerTypes).val()==1) {
      if ($("#Dockeywords-"+headerTypes).val()!='') {
        var value = $("#Dockeywords-"+headerTypes).val().replace(" ", "");
        words = value.split(",");
        MandatoryKeywordsCount+=words.length;
      } 
    }

    if ($("#is_mandatory-"+headerTypes).val()==0) {
      if ($("#Dockeywords-"+headerTypes).val()!='') {
        var value1 = $("#Dockeywords-"+headerTypes).val().replace(" ", "");
        words1 = value1.split(",");
        KeywordsCount+=words1.length;
      }
    }
  });

    $("select[name=headerTypes]").each(function(){
      headerTypes= $(this).attr('id');
      //console.log(headerTypes+" j "+$("#"+headerTypes+" :selected").text());
      if ($("#Dockeywords-"+headerTypes).val()!='') {

        keywords="\"" + $("#Dockeywords-"+headerTypes).val().split(",").join( "\",\"") + "\"";
        header = $("#"+headerTypes).val();

        if ($("#is_mandatory-"+headerTypes).val()==1) {
          count_mand++;
          if (count_mand>1) {
            mand+=',';
          }else{
            mand+='';
          }
          mand+='{"'+$("#"+headerTypes+" :selected").text()+'":['+keywords+']}';
        }  


        if ($("#is_mandatory-"+headerTypes).val()==0) {
          count_norm++;
          if (count_norm>1) {
            normal+=',';
          }else{
            normal+='';
          }
          normal+='{"'+$("#"+headerTypes+" :selected").text()+'":['+keywords+']}';
        } 

      }
    });

    if (ocrType == 1 || ocrType == 2) {
      docDef+='{"Count":"1","'+ocrDocType+'":{"Header":"'+header_length+'","Footer":"'+footer_length+'","KeyWordCutOff":"'+KeyWordCutOff+'","LowerCaseSearch":"'+LowerCaseSearch+'","Confidence":"'+min_confidence+'","docTypeUID":"'+docTypeUID+'","KeywordsCount":"'+KeywordsCount+'","MandatoryKeywordsCount":"'+MandatoryKeywordsCount+'","MandatoryKeywords":['+mand+'],"Keywords":['+normal+']}}';
    }else{
      docDef+='"'+ocrDocType+'":{"Header":"'+header_length+'","Footer":"'+footer_length+'","KeyWordCutOff":"'+KeyWordCutOff+'","LowerCaseSearch":"'+LowerCaseSearch+'","Confidence":"'+min_confidence+'","docTypeUID":"'+docTypeUID+'","KeywordsCount":"'+KeywordsCount+'","MandatoryKeywordsCount":"'+MandatoryKeywordsCount+'","MandatoryKeywords":['+mand+'],"Keywords":['+normal+']}';
    }
    var mySearch = ocrDocType;
    var tr =[];
    var a = $('table tbody tr td:contains("' + mySearch + '")').filter
    (function(){
        //alert($.trim($(this).text()));
        if($.trim($(this).text()) == mySearch){
          var tr_id = $(this).closest('tr').attr('id');
          if(jQuery.inArray(tr_id, tr) !== -1){

          }else{
            tr.push(tr_id);
          }

          return true;
        }
        else{
          return false;
        }
      });
   // console.log(docDef)
    $.ajax({
      type:'post',
      url:'<?php echo base_url();?>ocr/sendDataByDocdef',
      dataType:'json',
      data:{'file':file,'OrderUID':OrderUID,'docDef':docDef,'ocrType':ocrType,'PageNo':pageNo,'docTypeUID':docTypeUID},
      success:function(data){
        $("#myModal").modal('hide');
        //console.log(data)
        if (data) {
          var count_oge=0;
          var count_green=0;
          var count_oge=0;
          var count_purple=0;

          $(".total_classified").html('');
          $.each(data, function(key,value) {
            var color='';

            var page_no=value;

            var pageNo=page_no[0].pageNo;
console.log(ocrType+' '+pageNo+' == '+$("#pageNo").val())
            if (ocrType ==1) {
              if( pageNo == $("#pageNo").val()){
              if ((((page_no[0].pageConfidence)*100).toFixed())>=75 || (((page_no[0].pageConfidence)*100).toFixed())==0) {
              color='#0080009c';
              count_green++;
            }else if(((page_no[0].pageConfidence)*100).toFixed()>=50 && ((page_no[0].pageConfidence)*100).toFixed()<75 ){
              color='#0000ff38';
              count_purple++;
            }else if (((page_no[0].pageConfidence)*100).toFixed()<50 && (((page_no[0].pageConfidence)*100).toFixed())!=0) {
              count_oge++;
              color='#fff';
            }
            $("#pageConfidence-"+pageNo).empty();
          //$("#ocrCategoryName-"+pageNo).empty();
          $("#pageConfidence-"+pageNo).append(((page_no[0].pageConfidence)*100).toFixed());
          //$("#ocrCategoryName-"+pageNo).append(ocrDocType);

          $("#manualOCR-"+pageNo+" > option").each(function(){     
            if($(this).val()==ocrDocType){ // EDITED THIS LINE
              $(this).attr("selected","selected");    
            }    
          });
          $("#pageConfidence-"+pageNo).css('background',color);
          $("#"+pageNo).css('background',color);
          }
            }else{
            

            if ((((page_no[0].pageConfidence)*100).toFixed())>=75 || (((page_no[0].pageConfidence)*100).toFixed())==0) {
              color='#0080009c';
              count_green++;
            }else if(((page_no[0].pageConfidence)*100).toFixed()>=50 && ((page_no[0].pageConfidence)*100).toFixed()<75 ){
              color='#0000ff38';
              count_purple++;
            }else if (((page_no[0].pageConfidence)*100).toFixed()<50 && (((page_no[0].pageConfidence)*100).toFixed())!=0) {
              count_oge++;
              color='#fff';
            }
            $("#pageConfidence-"+pageNo).empty();
          //$("#ocrCategoryName-"+pageNo).empty();
          $("#pageConfidence-"+pageNo).append(((page_no[0].pageConfidence)*100).toFixed());
          //$("#ocrCategoryName-"+pageNo).append(ocrDocType);

          $("#manualOCR-"+pageNo+" > option").each(function(){     
            if($(this).val()==ocrDocType){ // EDITED THIS LINE
              $(this).attr("selected","selected");    
            }    
          });
          $("#pageConfidence-"+pageNo).css('background',color);
          $("#"+pageNo).css('background',color);
        }
        }); 
        }    
      },
      error:function(error,errorThhrown){
        console.log(error)
      }
    });

  });
</script>

<script type="text/javascript">
  $("#ocrDocType").change(function(){
    var DocumentTypeUID = $(this).val();
    $("#docTypeUID").val(DocumentTypeUID);
  })
</script>