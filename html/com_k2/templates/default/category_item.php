<?php

/**
 * @package		K2
 * @author		GavickPro http://gavick.com
 */

// no direct access
defined('_JEXEC') or die;

// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);

?>

<article class="itemView group<?php echo ucfirst($this->item->itemGroup); ?><?php echo ($this->item->featured) ? ' itemIsFeatured' : ''; ?><?php if($this->item->params->get('pageclass_sfx')) echo ' '.$this->item->params->get('pageclass_sfx'); ?>"> 
	<?php echo $this->item->event->BeforeDisplay; ?> 
	<?php echo $this->item->event->K2BeforeDisplay; ?>
		
	<div class="itemBody<?php
	if(
		$this->item->params->get('catItemHits') ||
		$this->item->params->get('catItemCategory') ||
		$this->item->params->get('itemPrintButton') ||
		$this->item->params->get('itemEmailButton') ||
		($this->item->params->get('catItemAuthor') && empty($this->item->created_by_alias)) ||
		($this->item->params->get('catItemTags') && count($this->item->tags))
	) :
	?> containsItemInfo<?php endif; ?>"> 	
		<?php if($this->item->params->get('catItemImage') && !empty($this->item->image)): ?>
		    <a href="<?php echo $this->item->link; ?>" title="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" class="itemImage">
		    	<img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" />
		    </a>
		    
		    <?php if($this->item->params->get('itemImageMainCaption') && !empty($this->item->image_caption)): ?>
		    <span class="itemImageCaption"><?php echo $this->item->image_caption; ?></span>
		    <?php endif; ?>
		    <?php if($this->item->params->get('itemImageMainCredits') && !empty($this->item->image_credits)): ?>
		    <span class="itemImageCredits"><?php echo $this->item->image_credits; ?></span>
		    <?php endif; ?>
		<?php endif; ?>
	
		<header>
			<?php if(isset($this->item->editLink)): ?>
			<a class="catItemEditLink modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>">
				<?php echo JText::_('K2_EDIT_ITEM'); ?>
			</a>
			<?php endif; ?>

			<?php
				if(
					$this->item->params->get('catItemDateCreated') ||
					$this->item->params->get('catItemAuthor') ||
					$this->item->params->get('catItemCommentsAnchor') ||
					($this->item->params->get('catItemDateModified') && $this->item->created != $this->item->modified)
				) :
			?>
			<ul>
				<?php if($this->item->params->get('catItemDateCreated')): ?>
				<li class="itemDate">
					<time datetime="<?php echo JHtml::_('date', $this->item->created, JText::_(DATE_W3C)); ?>">
						<?php echo JHTML::_('date', $this->item->created, JText::_('F j, Y')); ?>
					</time>
				</li>
				<?php endif; ?>
				
				<?php if($this->item->params->get('catItemAuthor')): ?>
				<li class="itemAuthor"> <?php echo K2HelperUtilities::writtenBy($this->item->author->profile->gender); ?> 
					<?php if(isset($this->item->author->link) && $this->item->author->link): ?>
					<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
					<?php else: ?>
					<?php echo $this->item->author->name; ?>
					<?php endif; ?> 
				</li>
				<?php endif; ?>
				
				<?php if($this->item->params->get('catItemCommentsAnchor')): ?>
				<li class="itemComments"> 
				<?php if(!empty($this->item->event->K2CommentsCounter)): ?>
					<!-- K2 Plugins: K2CommentsCounter -->
					<?php echo $this->item->event->K2CommentsCounter; ?>
				<?php else: ?>
					<?php if($this->item->numOfComments > 0): ?>
					<a href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
						<?php echo $this->item->numOfComments; ?> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
					</a>
					<?php else: ?>
					<a href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
						<?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
					</a>
					<?php endif; ?>
				<?php endif; ?>
				</li>
				<?php endif; ?>
				
				<?php if($this->item->params->get('catItemDateModified') && $this->item->created != $this->item->modified): ?>
				<li class="itemDateModified"> <?php echo JText::_('K2_LAST_MODIFIED_ON'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?>
				</li>
				<?php endif; ?>
			</ul>
			<?php endif; ?>
			
			<?php if($this->item->params->get('catItemTitle')): ?>
			<h2>
				<?php if ($this->item->params->get('catItemTitleLinked')): ?>
					<a href="<?php echo $this->item->link; ?>"><?php echo $this->item->title; ?></a>
				<?php else: ?>
					<?php echo $this->item->title; ?>
				<?php endif; ?>	
			</h2>
			<?php endif; ?>
			
			<?php if($this->item->params->get('catItemFeaturedNotice') && $this->item->featured): ?>
			<span class="itemFeature"><?php echo JText::_('K2_FEATURED'); ?></span>
			<?php endif; ?>
		</header>
			
		<?php echo $this->item->event->AfterDisplayTitle; ?> 
		<?php echo $this->item->event->K2AfterDisplayTitle; ?>
	
		<?php echo $this->item->event->BeforeDisplayContent; ?> 
		<?php echo $this->item->event->K2BeforeDisplayContent; ?>
		
		<?php if($this->item->params->get('catItemIntroText')): ?>
		<div class="itemIntroText"> <?php echo $this->item->introtext; ?> </div>
		<?php endif; ?>
			
		<?php if($this->item->params->get('catItemExtraFields') && count($this->item->extra_fields)): ?>
		<div class="itemExtraFields">
			<h4><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
			<ul>
				<?php foreach ($this->item->extra_fields as $key=>$extraField): ?>
				<?php if($extraField->value != ''): ?>
				<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
					<?php if($extraField->type == 'header'): ?>
					<h4 class="catItemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
					<?php else: ?>
					<span class="catItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
					<span class="catItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
					<?php endif; ?>
				</li>
				<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
			
		<?php if($this->item->params->get('catItemVideo') && !empty($this->item->video)): ?>
		<div class="itemVideoBlock">
			<h3><?php echo JText::_('K2_RELATED_VIDEO'); ?></h3>
			<?php if($this->item->videoType=='embedded'): ?>
			<div class="itemVideoEmbedded"> <?php echo $this->item->video; ?> </div>
			<?php else: ?>
			<span class="itemVideo"><?php echo $this->item->video; ?></span>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		
		<?php if($this->item->params->get('catItemImageGallery') && !empty($this->item->gallery)): ?>
		<div class="itemImageGallery">
			<h4><?php echo JText::_('K2_IMAGE_GALLERY'); ?></h4>
			<?php echo $this->item->gallery; ?> 
		</div>
		<?php endif; ?>
			
		<?php if($this->item->params->get('catItemAttachments') && count($this->item->attachments)): ?>
		<div class="itemAttachmentsBlock"> <span><?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS'); ?></span>
			<ul class="itemAttachments">
				<?php foreach ($this->item->attachments as $attachment): ?>
				<li> <a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>"> <?php echo $attachment->title ; ?> </a>
					<?php if($this->item->params->get('catItemAttachmentsCounter')): ?>
					<span>(<?php echo $attachment->hits; ?> <?php echo ($attachment->hits==1) ? JText::_('K2_DOWNLOAD') : JText::_('K2_DOWNLOADS'); ?>)</span>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
			
		<?php if ($this->item->params->get('catItemReadMore')): ?>
		<a class="itemReadMore button" href="<?php echo $this->item->link; ?>"> <?php echo JText::_('K2_READ_MORE'); ?> </a>
		<?php endif; ?>
		
		<?php echo $this->item->event->AfterDisplayContent; ?> 
		<?php echo $this->item->event->K2AfterDisplayContent; ?>
			
		<?php echo $this->item->event->AfterDisplay; ?> 
		<?php echo $this->item->event->K2AfterDisplay; ?>
	</div>

	<?php
	if(
		$this->item->params->get('catItemHits') ||
		$this->item->params->get('catItemCategory') ||
		$this->item->params->get('itemPrintButton') ||
		$this->item->params->get('itemEmailButton') ||
		($this->item->params->get('catItemAuthor') && empty($this->item->created_by_alias)) ||
		($this->item->params->get('catItemTags') && count($this->item->tags))
	) :
	?>
	<aside class="itemAsideInfo">
		<?php if($this->item->params->get('catItemAuthor') && empty($this->item->created_by_alias)): ?>
			<?php if($this->item->params->get('itemAuthorImage') && !empty($this->item->author->avatar)):?>
			<img src="<?php echo $this->item->author->avatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($this->item->author->name); ?>" />
			<?php endif; ?>
			
			<?php if($this->item->params->get('itemAuthorEmail')):?>
			<?php echo JHTML::_('Email.cloak', $this->item->author->email); ?>
			<?php endif; ?>
			
			<?php echo $this->item->event->K2UserDisplay; ?>
		<?php endif; ?>
		
		<?php
		if(
			$this->item->params->get('catItemHits') ||
			$this->item->params->get('catItemCategory') ||
			$this->item->params->get('itemPrintButton') ||
			$this->item->params->get('itemEmailButton') ||
			($this->item->params->get('catItemTags') && count($this->item->tags))
		) :
		?>
		<ul>
			<?php if($this->item->params->get('catItemCategory')): ?>
			<li class="itemCategory">
				<p><?php echo JText::_('K2_PUBLISHED_IN'); ?></p>
				<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a> </li>
			<?php endif; ?>
			
			<?php if($this->item->params->get('catItemHits')): ?>
			<li class="itemHits"> <?php echo JText::_('K2_READ'); ?> <?php echo $this->item->hits; ?> <?php echo JText::_('K2_TIMES'); ?> </li>
			<?php endif; ?>
			
			<?php if($this->item->params->get('catItemTags') && count($this->item->tags)): ?>
			<li class="itemTagsBlock">
				<p><?php echo JText::_('K2_TAGGED_UNDER'); ?></p>
				<?php foreach ($this->item->tags as $tag): ?>
				<a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?>, </a>
				<?php endforeach; ?>
			</li>
			<?php endif; ?>
		</ul>
		<?php endif; ?>
	</aside>
	<?php endif; ?>
</article>