# To-do

- Rename 'type' to 'category'
- Clicking on an image will open a modal with more information:
    - Filename as title (not path)
    - Image width and height
    - Image URL (with copy to clipboard button)
    - Image path (for use in maps, with copy to clipboard button - must act differently for transformice.com images since it may need to look up directories with "../")
    - Tutorial to add backgrounds to maps (https://atelier801.com/topic?f=6&t=795709)
    - Tutorial to use images in modules (maybe also #utility tutorial)
- Add links
    - shamo.us/ey
    - Forum thread
- http://derpolino.alwaysdata.net/imagetfm/
- Tagging images with text (ie. module images might be tagged with `pokemon` or `background` or something)
- Tree view for transformice.com images

## API Documentation

- `GET tfm.pics/api/images/transformice.com`
- `GET tfm.pics/api/images/images.atelier801.com`
- `POST tfm.pics/api/create` where the property `links` is a string that contains links separated by `\n` linebreaks
