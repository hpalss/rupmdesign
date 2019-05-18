<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Proposal</title>
    <style type="text/css">
        @media only screen and (max-width:768px) {
            .logo td {
                padding-top: 15px !important;
                padding-bottom: 10px !important;
                padding-left: 10px;
            }
            .logo .hide {
                display: none;
            }
            table.container {
                width: 100% !important;
                background-color: #ffffff !important;
                padding: 0 !important;
                border-spacing: 0 !important;
                border-collapse: collapse !important;
            }
            table.header {
                width: 100% !important;
            }
        }
        
        @media only screen and (max-width:600px) {
            .logo td {
                padding-top: 15px !important;
                padding-bottom: 10px !important;
                padding-left: 10px;
            }
            .logo .hide {
                display: none;
            }
            table.container {
                width: 100% !important;
                background-color: #ffffff !important;
                padding: 0 !important;
                border-spacing: 0 !important;
                border-collapse: collapse !important;
            }
            table.header {
                width: 100% !important;
            }
            table.header .title {
                font-size: 16px !important;
                font-weight: bold;
            }
            table.header #pencil-icon img {
                width: 25px !important;
                height: 25px !important;
            }
            table.header #check-mark img {
                width: 36px !important;
                height: 33px !important;
                border-radius: 50%;
            }
            #job-title {
                padding-top: 5px;
            }
            #job-title a {
                font-size: 13px !important;
            }
            .job-description {
                font-size: 13px !important;
            }
            .job-description a {
                font-size: 13px !important;
                color: #668ba8 !important;
            }
            .proposal-amount {
                font-size: 13px !important;
            }
            .view {
                width: 80px !important;
            }
            #view-proposal {
                width: 240px !important;
            }
            #view-proposal td a {
                font-size: 12px;
            }
        }
    </style>
</head>
<?php 
 $proposalAmount = "";
 $totalProjectAmount = "";
 if (isset($proposal['bid_amount'])) {
    $proposalAmount = $proposal['bid_amount'];
    $estimateAmount = filter_var($proposalAmount, FILTER_SANITIZE_NUMBER_FLOAT);
    $percentage=0.3;
    $totalProjectAmount = $estimateAmount;
    if ($totalProjectAmount<100) {
        $percentage = 1;
    }else if ($totalProjectAmount>=100 && $totalProjectAmount<=400) {
        $percentage = 0.5;
    }
    $totalProjectAmount = $totalProjectAmount*$percentage;
 }
 ?>

<body style="margin:0; padding:0;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
        <!--Email title-->
        <tr>
            <td bgcolor="#ededed" style="font-family:arial,helvetica,sans-serif;">
                <table role="presentation" cellspacing="3" cellpadding="0" align="left" style="padding-top:10px;padding-bottom:10px;">
                    <tr>
                        <td style="font-size:18px;color:#51514f;"><?=lang("new_proposal_email")?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <!--End email title-->
        <!--logo-->
        <tr>
            <td bgcolor="#ffffff">
                <table class="container logo" role="presentation" cellspacing="0" cellpadding="0" width="600" align="center">
                    <tr>
                        <td align="left" style="font-size:0;padding-top:5px;">
                            <img src="https://my.sbs-studies.gr/files/system/_file5745facea0df7-site-logo.png" alt="logo" style="display:block;" width="120px">
                        </td>
                    </tr>
                    <tr class="hide">
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <!--logo-->
        <tr>
            <td bgcolor="#ededed" align="center" style="font-family:Arial,helvetica,sans-serif;">
                <!--main section-->
                <table class="container" role="presentation" cellpadding="12" cellspacing="20" width="600">
                    <tr>
                        <td bgcolor="#ffffff">
                            <!--header of the section-->
                            <table class="header" role="presentation" cellpadding="0" cellspacing="0" width="600" style="border-bottom:1px solid #e1e1e1;padding-bottom:10px;">
                                <tr>
                                    <td align="left">
                                        <table role="presentation" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="font-size:0;" id="pencil-icon">
                                                    <img src="https://i.imgur.com/8sLIt6O.png" alt="pencil" width="30px" height="34px" style="display:block;">
                                                </td>
                                                <td class="title" style="font-size:26px;color:#51514f;"><?=lang("new_proposal_email")?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right">
                                        <table role="presentation" cellpadding="0" cellspacing="0" align="right">
                                            <tr>
                                                <td id="check-mark" style="font-size:0;" align="right">
                                                    <img src="https://i.imgur.com/2PmfrME.png" alt="check-mark" style="display:block;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>

                                    <td id="job-title" style="color:#329BB6;">
                                        <a href="<?=$proposal['viewLink']?>" target="_blank" style="text-decoration:none;color:#329BB6;font-size:16px;line-height:20px;">"<?=$estimate->title?>"</a>
                                    </td>
                                </tr>
                            </table>
                            <!--End header of the section-->
                            <!--section body-->
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="job-description" id="name" style="color:#575757;font-size:15px;line-height:20px;">
                                        Γεια σου <?=$estimate->company_name?>,
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="job-description" style="color:#329BB6;font-size:15px;">
                                        <span style="color:#4d5152!important;"><?=lang("proposal_claim_text")?></span>
                                        <a href="<?=$proposal['viewLink']?>" target="_blank" style="text-decoration:none;color:#329BB6!important;font-size:15px;line-height:21px;">"<?=$estimate->title?>"</a>

                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="job-description" style="color:#4d5152!important;font-size:15px;line-height:20px;">
                                        <?=lang('proposal_details_label')?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <!--Grey section in the middle-->
                                <tr>
                                    <td bgcolor="#ededed">
                                        <table role="presentation" cellspacing="0" cellpadding="0" width="100%">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="job-description" style="padding-left:10px;padding-right:10px;line-height:23px;color:#575151;font-size:15px;">
                                                    <?=$proposal['description']?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#dedede">
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td>
                                                                <table class="amount-table" role="presentation" cellspacing="0" cellpadding="10" align="left">
                                                                    <tr>
                                                                        <td class="proposal-amount" align="left" style="color:#4b5049;font-size:15px;">
                                                                            <b><?=lang("proposal_amount")?> €<?=$proposalAmount?></b>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="proposal-amount" align="left" style="color:#4b5049;font-size:15px;">
                                                                            <b><?=lang("deposit")?> €<?=$totalProjectAmount?></b>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td align="right">
                                                                <table role="presentation" cellspacing="0" cellpadding="10" align="right">
                                                                    <tr>
                                                                        <td align="right">
                                                                            <table class="view" role="presentation" cellspacing="0" cellpadding="0" align="right" width="110" height="28">
                                                                                <tr>
                                                                                    <td align="center" bgcolor="#ff7300" style="color:#ffffff;font-size:14px;border-radius:5px;">
                                                                                        <a href="<?=$proposal['viewLink']?>" style="text-decoration:none;color:#ffffff;"><b><?=lang("btn_view")?></b></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!--End Grey section-->

                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="job-description" align="left" style="color:#4b5049;font-size:14px;">
                                        <?=lang('proposal_email_confrimation')?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <!--View proposal btn-->

                                <tr>
                                    <td align="center">
                                        <table id="view-proposal" role="presentation" cellspacing="0" cellpadding="0" align="center" width="300" height="35">
                                            <tr>
                                                <td align="center" bgcolor="#ff7300" style="color:#ffffff;font-size:14px;border-radius:4px;">
                                                    <a href="<?=$proposal['viewLink']?>" style="text-decoration:none;color:#ffffff;"><b><?=lang("btn_view_proposal")?></b></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!--End view proposal btn-->
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                            <!--section body end-->
                        </td>
                    </tr>
                    <!--End main section row-->

                </table>
                <!--main-section end-->
            </td>
        </tr>
        <!-- footer-->
        <tr>
            <td align="center" style="font-family:arial,helvetica,sans-serif;">
                <table class="container" cellpadding="0" cellspacing="0" role="presentation" width="600" bgcolor="#ffffff">
                    <tbody><tr>
                        <td>
                            <table role="presentation" border="0" cellpadding="15" cellspacing="0" width="100%" align="center">
                                <tbody><tr>
                                    <td align="center" style="font-family:arial,helvetica,sans-serif;">
                                        <table role="presentation" cellpadding="2" cellspacing="0" align="center">
                                            <tbody><tr>
                                                <td>
                                                    <table role="presentation" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody><tr>
                                                            <td align="center">
                                                                <a href="https://www.facebook.com/" target="_blank"><img src="https://i.imgur.com/1blZxeU.png" alt="facebook" style="display:block;" width="27px" height="27px"></a>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                                <td>
                                                    <table role="presentation" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody><tr>
                                                            <td>
                                                                <a href="https://www.twitter.com/" target="_blank"><img src="https://i.imgur.com/IZvv5lq.png" alt="facebook" style="display:block;" width="27px" height="27px"></a>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                                <td>
                                                    <table role="presentation" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody><tr>
                                                            <td>
                                                                <a href="https://www.linkedin.com/" target="_blank"><img src="https://i.imgur.com/YFLFYN4.png" alt="facebook" style="display:block;" width="27px" height="27px"></a>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                                <td>
                                                    <table role="presentation" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody><tr>
                                                            <td>
                                                                <a href="https://www.pinterest.com/" target="_blank"><img src="https://i.imgur.com/xF3PEWL.png" alt="facebook" style="display:block;" width="25px" height="25px"></a>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                                <td>
                                                    <table role="presentation" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody><tr>
                                                            <td>
                                                                <a href="#" target="_blank"><img src="https://i.imgur.com/9ZibYE3.png" alt="facebook" style="display:block;" width="17px" height="17px"></a>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>

                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="font-size:11px;color:#898c91;">
                            Ⓒ<?=date("Y");?> - <a href="https://www.sbs-studies.gr/" target="_blank">SBS Studies - Φοιτητικό Φροντιστήριο</a> - <a href="https://www.sbs-studies.gr/epikoinonia" target="_blank">ΕΠΙΚΟΙΝΩΝΙΑ</a>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size:11px;color:#898c91;line-height:18px;">
                            Το παρόν μήνυμα έχει καθαρά ενημερωτικό χαρακτήρα για τις υπηρεσίες που ζητήσατε από το SBS Studies. Σε περίπτωση που λάβατε καταλάθος το παρόν μήνυμα ή αντιμετωπίζετε οποιοδήποτε πρόβλημα παρακαλώ να το αναφέρετε άμεσα στο 2510 837211 ή στο info@sbs-studies.gr 
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="font-size:11px;color:#5dbcd2;line-height:30px;">
                            <a href="https://my.sbs-studies.gr/index.php/dashboard" style="text-decoration:none;color:#5dbcd2;">Αλλαγή ρυθμίσεων ειδοποιήσεων |</a> <a href="mailto:info@sbs-studies.gr" style="text-decoration:none;color:#5dbcd2;">Διαγραφή από τη λίστα</a>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
        <!--End footer-->
    </table>

</body>

</html>
