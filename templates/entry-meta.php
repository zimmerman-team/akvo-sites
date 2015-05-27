<time class="updated date" datetime="<?= get_the_time('c'); ?>"><?= get_the_date(); ?></time>
<span post_class('type'); ?><?php echo get_post_type(); ?></span>
<span class="byline author vcard"><?= __('By', 'sage'); ?> <?= get_the_author(); ?></span>