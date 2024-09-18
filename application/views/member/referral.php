<style>
.affiliate-referral-link {
    margin: 40px 0;
}
.affiliate-referral-link span {
    display: block;
    margin: 0;
    padding: 10px;
    font-size: 1.4em;
    border-radius: 10px;
    border: 1px solid #ccc;
    overflow: hidden;
}
.affiliate-stat {
    margin: 0;
    padding: 15px;
    font-size: 1.6em;
    text-align: center;
}
.affiliate-stat i {
    float: left;
    padding: 10px;
    font-size: 4em;
}
.affiliate-stat span {
    display: block;
    font-size: 2.4em;
}
</style>
<div class="dashboard">
  <div class="row">
    <div class="col-lg-12">
      <h2>Referral</h2>
    </div>
  </div>


<div class="row">
<div class="col-sm-4">
<div class="affiliate-stat affiliate-stat-green alert-warning">
<i class="glyphicon glyphicon-user"></i>
<span><?php echo $Member[0]['ReferralClicks']; ?></span>
Clicks
 </div>
</div>
<div class="col-sm-4">
<div class="affiliate-stat affiliate-stat-green alert-info">
<i class="glyphicon glyphicon-star"></i>
<span><?php echo $Signups; ?></span>
Signups
</div>
</div>
<div class="col-sm-4">
<div class="affiliate-stat affiliate-stat-green alert-success">
<i style="padding-top: 0px;">$</i>
<span><?php echo number_format($Commission[0]['Amount'], 2) ?></span>
Commission
</div>
</div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="affiliate-referral-link text-center">
      <h3>Your Unique Referral Link</h3>
      <span><?php echo site_url('register'); ?>?referral=<?php echo $this->session->userdata('MemberID'); ?></span>
    </div>
  </div>
</div>

</div>