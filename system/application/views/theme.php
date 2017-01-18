<style>
    .cs-button-certify {
        font-size: 0.75rem;
        border: solid 1px silver;
        padding: 0.25rem;
    }
</style>
<?php if ($this->dx_auth->is_logged_in() && $this->dx_auth->is_admin()) {
    $certifications = $this->db->get("themes_certifications"); ?>
    Certification:
    <a href="<?= "/themes/certify/$id/0" ?>" class='cs-button-certify'>Un-certify</a>
    <?php foreach ($certifications->result() as $certif) { ?>
        <a href="<?= "/themes/certify/$id/$certif->id" ?>" class='cs-button-certify'><?= "Certify $certif->name" ?></a>
    <?php } ?>
    <hr>
<?php } ?>

<?php $this->view('_item_details_head',['type'=>'themes']) ?>

<?php $this->view('_item_info') ?>

<?php $this->view('_comments',['type'=>'themes']); ?>
