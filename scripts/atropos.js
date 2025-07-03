     const myAtropos = Atropos({
        el: ".my-atropos",
        activeOffset: -40,
        shadowScale: 1,
        highlight: true,
        onEnter() {
          console.log("Atropos entered");
        },
        onLeave() {
          console.log("Atropos left");
        },
        onRotate(x, y) {
          console.log("Atropos rotated: ", x, y);
        },
        // rest of parameters
      });

      const myAtropos2 = Atropos({
        el: ".my-atropos2",
        activeOffset: -40,
        shadowScale: 1,
        highlight: true,
        onEnter() {
          console.log("Atropos entered");
        },
        onLeave() {
          console.log("Atropos left");
        },
        onRotate(x, y) {
          console.log("Atropos rotated: ", x, y);
        },
        // rest of parameters
      });
