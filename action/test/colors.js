// Định nghĩa các nhóm màu chính
const colorGroups = [
    { name: 'Red', range: ['#FF0000', '#FFCCCC'] },
    { name: 'Green', range: ['#00FF00', '#CCFFCC'] },
    { name: 'Blue', range: ['#0000FF', '#CCCCFF'] },
    { name: 'Yellow', range: ['#FFFF00', '#FFFFCC'] },
    { name: 'Orange', range: ['#FFA500', '#FFDAB9'] },
    { name: 'Purple', range: ['#800080', '#E6E6FA'] },
    // Add more color groups as needed
];

function getColorGroup(hex) {
    let colorName = 'Unknown';
    const color = chroma(hex);

    colorGroups.forEach(group => {
        const [start, end] = group.range;
        if (chroma(hex).luminance() >= chroma(start).luminance() &&
            chroma(hex).luminance() <= chroma(end).luminance()) {
            colorName = group.name;
        }
    });

    return colorName;
}
