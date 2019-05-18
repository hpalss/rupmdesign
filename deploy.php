<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'rupm');

// Project repository
set('repository', 'git@gitlab.com:abdulmanan7/rupm.git');
set('branch', 'master');
set('default_stage', 'staging');
// Hosts

host('genieos.io')
->user('x7onx9oo5ob2')
->stage('staging')
    ->set('deploy_path', '~/public_html/rupm/');

desc('Deploy your project');
task('deploy', function(){
    $deployPath = get('deploy_path');
    $repo = get('repository');
    cd($deployPath);
    run("git pull");
});
