<?php

namespace Drupal\zarpele_migrate\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Multipurpose custom plugin to modify the body field.
 *
 * Example:
 *
 * @code
 * process:
 *   field_json:
 *     plugin:  zarpele_clean_text
 *     source: body
 * @endcode
 *
 * @MigrateProcessPlugin(
 *   id = "zarpele_clean_text"
 * )
 */
class CleanText extends ProcessPluginBase {

  const SEARCH = [
  // Zarpele will use a .com domain now, replacing then...
    'www.zarpele.com.ar',
  // The public Wordpress folder was added in sites/default/files.
    '/wp-content/',
    '[php]',
    '[/php]',
    '[bash]',
    '[/bash]',
  ];

  const REPLACE = [
    'www.zarpele.com',
    '/sites/default/files/wp-content/',
    '<pre><code class="language-php">',
    '</code></pre>',
    '<pre><code class="language-bash">',
    '</code></pre>',
  ];

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    return str_replace($this::SEARCH, $this::REPLACE, $value);
  }

}
