          <table class="table table-bordered">
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