<ul class="nav <?php echo (!empty($secondary)) ? 'secondary-nav pull-right' : ''; ?>" >
    <?php foreach($menu as $item) : ?>
        <?php if (!isset($item['dropdown'])) : ?>
            <li><?php echo $this->Html->link(__($item['title']), $item['url']); ?></li>
        <?php else: ?>
            <li class="dropdown">
                <?php echo $this->Html->link($item['title'].'<b class="caret"></b>', '#', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'escape' => false)); ?>
                <ul class="dropdown-menu">
                    <?php foreach($item['dropdown'] as $subItem): ?>
                        <li><?php echo $this->Html->link(__($subItem['title']), $subItem['url']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>