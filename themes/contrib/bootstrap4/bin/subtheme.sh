#!/usr/bin/env bash
#1.2

echo -e "STEP 1. Prerequisites."

# Check for correct params.
if [ $# -ne 2 ]; then
  echo -e "ERROR: Incorrect number of params.\n  Format: bash ./bin/subtheme.sh NAME PATH\n  Example:  bash ./bin/subtheme.sh b4subtheme ../custom\n  Note, no trailing slash in PATH."
  exit 1
fi

SUBTHEME=$1
SUBPATH=$2

# Check for existing theme.
if [ -d "$SUBPATH/$SUBTHEME" ]; then
  echo -e "ERROR: Directory <$SUBPATH/$SUBTHEME> already exists.\n  Remove it by running <rm -rf $SUBPATH/$SUBTHEME>"
  exit 1
fi

if [ ! -d "$SUBPATH" ]; then
  (mkdir -p $SUBPATH) || (echo "ERROR: Can't create directory." && exit 1)
  echo -e "Successfully created directory $SUBPATH"
fi

echo -e "STEP 2. Copying files."
cp -R _SUBTHEME $SUBPATH
mv $SUBPATH/_SUBTHEME $SUBPATH/$SUBTHEME
mv $SUBPATH/$SUBTHEME/SUBTHEME.libraries.yml $SUBPATH/$SUBTHEME/$SUBTHEME.libraries.yml
mv $SUBPATH/$SUBTHEME/SUBTHEME.theme $SUBPATH/$SUBTHEME/$SUBTHEME.theme
sed -e "s/SUBTHEME/$SUBTHEME/g" $SUBPATH/$SUBTHEME/SUBTHEME.info._yml > $SUBPATH/$SUBTHEME/$SUBTHEME.info.yml
rm $SUBPATH/$SUBTHEME/SUBTHEME.info._yml
mv $SUBPATH/$SUBTHEME/README.md $SUBPATH/$SUBTHEME/SUBTHEME.md.bak
echo -e "# $SUBTHEME theme\n\nSubtheme of [bootstrap 4](https://www.drupal.org/project/bootstrap4).\n\nEnter notes here." > $SUBPATH/$SUBTHEME/README.md
cp css/* $SUBPATH/$SUBTHEME/css/

echo -e "STEP 3. Copying style guide."
cp -R style-guide $SUBPATH/$SUBTHEME/

echo -e "STEP 4. Update SASS path."
PWD=$(pwd)
cd $SUBPATH/$SUBTHEME
SCSSPATH="../$(find  .. ../.. ../../.. ../../../.. ../../../../.. ../../../../../.. -type d -name 'scss' | grep 'bootstrap4/scss' | head -1)"
sed -i.bak "s#\[DOCROOT\]/themes/contrib/bootstrap4/scss#$SCSSPATH#g" scss/style.scss
rm scss/*.bak
cd $PWD

echo -e "SUCCESS! Theme <$SUBTHEME> was created in <$SUBPATH>!"
