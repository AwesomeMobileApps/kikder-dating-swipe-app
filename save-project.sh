#!/bin/bash

# Save the git project to a specific repo (e.g. github, gitlab, ...)
function save-project() {
    git remote rm origin
    git remote add origin $1
    git push
}

save-project git@bitbucket.org:pH_7/kikornot.git
save-project git@gitlab.com:pH-7/kikder-dating-swipe-app.git
save-project git@github.com:AwesomeMobileApps/kikder-dating-swipe-app.git

echo "Yaaay! That's done :)"
