<template>
  <div>
    <div class="flex justify-between">
      <title>Page Builder</title>
      <heading class="mb-6">
        Page Builder
      </heading>
      <button
        class="text-white flex-shrink-0 ring-primary-200 dark:ring-gray-600 dark:text-gray-800 shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 bg-primary-500 hover:bg-primary-400 active:bg-primary-600  dark:text-gray-800 font-bold px-4 h-9 text-sm ring-primary-200 dark:ring-gray-600 dark:text-gray-800 justify-center"
        @click="save"
      >
        Save
      </button>
    </div>
    <card class="mb-4 rounded-t-md">
      <div class="rounded-t-md bg-blue-200">
        <!--        Todo: Also need to delay this link until the save is complete so make this programmatic instead-->
        <button
          class="rounded-t-md  no-underline"
          @click="saveTempAndPreview"
        >
          <div class="p-4">
            <!--            Todo: To actaully make this work, we need a temp save field on-->
            <span class="font-bold text-gray-600">Preview This Page</span>
          </div>
        </button>
      </div>
      <div class="rounded-t-md">
        <Link
          :href="'/nova/resources/pages/' + id"
          class="rounded-t-md  no-underline"
          target="_blank"
        >
          <div class="p-4">
            <span class="font-bold text-gray-600">View This Resource</span>
          </div>
        </Link>
      </div>
    </card>

    <card
      class="bg-90 flex flex-col items-center justify-center"
      style="min-height: 300px"
    >
      <div id="editor" />
    </card>
  </div>
</template>

<script>
import grapesjs from 'grapesjs'
import basicBlocks from 'grapesjs-blocks-basic'
import presetWebpage from 'grapesjs-preset-webpage'
import pluginNavbar from 'grapesjs-navbar'
import pluginCountdown from 'grapesjs-component-countdown'
import pluginForms from 'grapesjs-plugin-forms'
import pluginExport from 'grapesjs-plugin-export'
import pluginStyleBg from 'grapesjs-style-bg'
import pluginStyleBgGradient from 'grapesjs-style-gradient'
import pluginCustomCode from 'grapesjs-custom-code'
import pluginTooltip from 'grapesjs-tooltip'
import pluginTui from 'grapesjs-tui-image-editor'
import pluginTabs from 'grapesjs-tabs'
import pluginTable from 'grapesjs-table'
import pluginFlexbox from 'grapesjs-blocks-flexbox'

import custom from '../plugins/custom'
import 'grapesjs/dist/css/grapes.min.css'
let editor

export default {
  metaInfo () {
    return {
      title: 'Page Editor'
    }
  },
  props: {
    id: {
      type: Number,
      default: null
    }
  },
  data () {
    return {}
  },
  async mounted () {
    console.log('id')
    console.log(this.id)
    if (!this.id) {
      window.location.href = '/404'
    }

    let res = null
    try {
      res = await Nova.request().get('/nova-vendor/nova-3-grapesjs-page-builder/page/' + this.id)
    } catch (err) {
      console.log(err)
    }

    const random = (Math.random() * 1000000000).toFixed(0)
    const style = window.location.protocol + '//' + window.location.host + '/css/app.bundle.css?id=' + random

    editor = grapesjs.init({
      container: '#editor',
      storageManager: { autoload: 0 },
      pluginsOpts: {
        [basicBlocks]: {
          flexGrid: 1,
          stylePrefix: 'gjs-'
        }
      },
      // width: '100%',
      // mediaCondition: "min-width",
      plugins: [
        basicBlocks,
        presetWebpage,
        pluginFlexbox,
        pluginExport,
        pluginCountdown,
        pluginForms,
        pluginNavbar,
        // pluginTui,
        pluginTabs,
        pluginTooltip,
        pluginCustomCode,
        pluginStyleBg,
        pluginStyleBgGradient,
        // pluginTable,
        custom
      ],
      canvas: {
        styles: [style]
      },
      selectorManager: {
        componentFirst: true
      },
      styleManager: {
        sectors: [
          {
            name: 'General',
            open: false,
            buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom']
          }, {
            name: 'Dimension',
            open: false,
            buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding']
          }, {
            name: 'Typography',
            open: false,
            buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-shadow', 'text-align']
          }, {
            name: 'Decorations',
            open: false,
            buildProps: ['border-radius-c', 'background-color', 'border-radius', 'border', 'box-shadow', 'background']
          },
          {
            name: 'Flex',
            open: false,
            properties: [
              {
                name: 'Flex Container',
                property: 'display',
                type: 'select',
                defaults: 'block',
                list: [
                  {
                    value: 'block',
                    name: 'Disable'
                  },
                  {
                    value: 'flex',
                    name: 'Enable'
                  }
                ]
              },
              {
                name: 'Flex Parent',
                property: 'label-parent-flex',
                type: 'integer'
              },
              {
                name: 'Direction',
                property: 'flex-direction',
                type: 'radio',
                defaults: 'row',
                list: [
                  {
                    value: 'row',
                    name: 'Row',
                    className: 'icons-flex icon-dir-row',
                    title: 'Row'
                  },
                  {
                    value: 'row-reverse',
                    name: 'Row reverse',
                    className: 'icons-flex icon-dir-row-rev',
                    title: 'Row reverse'
                  },
                  {
                    value: 'column',
                    name: 'Column',
                    title: 'Column',
                    className: 'icons-flex icon-dir-col'
                  },
                  {
                    value: 'column-reverse',
                    name: 'Column reverse',
                    title: 'Column reverse',
                    className: 'icons-flex icon-dir-col-rev'
                  }
                ]
              },
              {
                name: 'Justify',
                property: 'justify-content',
                type: 'radio',
                defaults: 'flex-start',
                list: [
                  {
                    value: 'flex-start',
                    className: 'icons-flex icon-just-start',
                    title: 'Start'
                  },
                  {
                    value: 'flex-end',
                    title: 'End',
                    className: 'icons-flex icon-just-end'
                  },
                  {
                    value: 'space-between',
                    title: 'Space between',
                    className: 'icons-flex icon-just-sp-bet'
                  },
                  {
                    value: 'space-around',
                    title: 'Space around',
                    className: 'icons-flex icon-just-sp-ar'
                  },
                  {
                    value: 'center',
                    title: 'Center',
                    className: 'icons-flex icon-just-sp-cent'
                  }
                ]
              },
              {
                name: 'Align',
                property: 'align-items',
                type: 'radio',
                defaults: 'center',
                list: [
                  {
                    value: 'flex-start',
                    title: 'Start',
                    className: 'icons-flex icon-al-start'
                  },
                  {
                    value: 'flex-end',
                    title: 'End',
                    className: 'icons-flex icon-al-end'
                  },
                  {
                    value: 'stretch',
                    title: 'Stretch',
                    className: 'icons-flex icon-al-str'
                  },
                  {
                    value: 'center',
                    title: 'Center',
                    className: 'icons-flex icon-al-center'
                  }
                ]
              },
              {
                name: 'Flex Children',
                property: 'label-parent-flex',
                type: 'integer'
              },
              {
                name: 'Order',
                property: 'order',
                type: 'integer',
                defaults: 0,
                min: 0
              },
              {
                name: 'Flex',
                property: 'flex',
                type: 'composite',
                properties: [
                  {
                    name: 'Grow',
                    property: 'flex-grow',
                    type: 'integer',
                    defaults: 0,
                    min: 0
                  },
                  {
                    name: 'Shrink',
                    property: 'flex-shrink',
                    type: 'integer',
                    defaults: 0,
                    min: 0
                  },
                  {
                    name: 'Basis',
                    property: 'flex-basis',
                    type: 'integer',
                    units: ['px', '%', ''],
                    unit: '',
                    defaults: 'auto'
                  }
                ]
              },
              {
                name: 'Align',
                property: 'align-self',
                type: 'radio',
                defaults: 'auto',
                list: [
                  {
                    value: 'auto',
                    name: 'Auto'
                  },
                  {
                    value: 'flex-start',
                    title: 'Start',
                    className: 'icons-flex icon-al-start'
                  },
                  {
                    value: 'flex-end',
                    title: 'End',
                    className: 'icons-flex icon-al-end'
                  },
                  {
                    value: 'stretch',
                    title: 'Stretch',
                    className: 'icons-flex icon-al-str'
                  },
                  {
                    value: 'center',
                    title: 'Center',
                    className: 'icons-flex icon-al-center'
                  }
                ]
              }
            ]
          }
        ]
      }
    })

    // Todo Brandon: May need to re-enable
    // console.log(editor.Canvas.getBody())
    // console.log(editor.getWrapper())
    // editor.Canvas.getBody().classList.add('w-full')
    // editor.Canvas.getBody().classList.add('flex')
    editor.getWrapper().addClass('w-full h-full flex')

    // console.log(res.data)

    if (res && res.data && res.data.content) {
      editor.setStyle(res.data.custom_css)
      editor.setComponents(res.data.content)
    }
    editor.render() // Todo Brandon: Are we freezing on this one?
  },
  methods: {
    saveTempAndPreview () {
      Nova.request().post('/nova-vendor/nova-3-grapesjs-page-builder/page/' + this.id + '/temp', {
        content: editor.getHtml(),
        css: editor.getCss()
      })
        .then(res => {
          window.open('/preview/' + this.id, '_blank')
        })
        .catch(err => {
          console.log(err)
        })
    },
    save () {
      Nova.request().post('/nova-vendor/nova-3-grapesjs-page-builder/page/' + this.id + '/save', {
        content: editor.getHtml(),
        css: editor.getCss()
      })
        .then(res => {
          Nova.success('Page Saved.')
          // window.open("/hangar/" + res.data.slug, "_blank");
        })
        .catch(err => {
          console.log(err)
        })
    }
  }
}
</script>

<style>
/* Scoped Styles */
</style>
